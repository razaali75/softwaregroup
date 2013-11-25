(function() {

var $ = jQuery; 

$('.imitate-placeholder')
	.focus(handlePlaceholderFocus)
	.blur(handlePlaceholderBlur).blur()
	.parents('form').submit(handlePlaceholderSubmit);

//i don't really dig wrapping this stuff in a document ready call, but as WordPress loads the libraries beneath
//this, there's not really a better option
$(initPhotos);

function handlePlaceholderFocus(e) {
	var textbox = $(e.target);
	var defaultVal = textbox.attr('data-default');
	
	if (textbox.val() == defaultVal)
		textbox.val('').css({ color: '' });
}
function handlePlaceholderBlur(e) {
	var textbox = $(e.target);
	var defaultVal = textbox.attr('data-default');
	
	if (!textbox.val())
		textbox.val(defaultVal).css({ color: '#BBB' });
}
function handlePlaceholderSubmit(e) {	
	var imitatedPlaceholders = $(e.target.elements).filter('.imitate-placeholder');
	
	imitatedPlaceholders.each(function(i, item) {
		var textbox = $(item);
		
		if (textbox.val() == textbox.attr('data-default'))
			textbox.val('');
	});
}

$('.vr_listing_add_term a').click(function(e) {
	var newTerm = prompt('Please enter the new value you\'d like to add.');
	var selector = e.target.getAttribute('data-selector');
	var selectorDom = $('#' + selector);
	
	setSelectorTerm(newTerm, selectorDom);
	e.preventDefault();
});

/*if (mlsData.city) {
			setSelectorTerm(mlsData.city, $('#building_area'));
			loadedAnyData = true;
		}

if (mlsData.city) {
			setSelectorTerm(mlsData.city, $('#building_city'));
			loadedAnyData = true;
		}*/

function initPhotos() {
//	alert(vrSwfUploadSettings.flash_url);
	var uploader = new SWFUpload({
		upload_url: vrSwfUploadSettings.upload_url,
		flash_url: vrSwfUploadSettings.flash_url,
		post_params: vrSwfUploadSettings.post_params,
		
		file_size_limit: '10MB',
		file_types: '*.jpg',
		file_upload_limit: 100,
		file_post_name: 'async-upload',
		
		button_width: '82',
		button_height: '21',
		button_placeholder_id: 'vr_venue_uploader',
		button_image_url: vrSwfUploadSettings.button_image_url,
		
		file_dialog_complete_handler: handlePhotoDialog_complete,
		
		upload_start_handler: handlePhotoUpload_start,
		upload_progress_handler: handlePhotoUpload_progress,
		upload_error_handler: handlePhotoUpload_error,
		upload_success_handler: handlePhotoUpload_success
	});
	var uploaderQueueProgress = $('#vr_venue_uploader_queue_progress');
	var uploaderFileStatus = $('#vr_venue_uploader_file_status');
	var buildingPhotosContainer = $('#vr_venue_photos_container');
	
	buildingPhotosContainer.sortable({ containment: 'parent' });
	buildingPhotosContainer.click(function(e) {
		var target = $(e.target);
		var id;
		
		if (!target.is('.vr_venue_delete_photo'))
			return;
		if (!confirm('Are you certain you\'d like to delete this photo?'))
			return;
		
		var postData = {
			action: 'vr_venue_delete_photo',
			postId: $('#post_ID').val(),
			attachmentId: target.attr('data-id'),
			_ajax_nonce: $('#vr_venue_photos_ajax').val()
		};
		$.post(ajaxurl, postData, function(data) {
			buildingPhotosContainer.html(data).sortable('refresh');
		});
	});
	
	$('#post').submit(function(event) {
		var orderedIds = $.map($('#vr_venue_photos_container img'), function(img) {
			return img.getAttribute('data-id');
		});
		$('#_photos_order').val(orderedIds.join(','));
	});
	
	function handlePhotoDialog_complete() {
		uploader.startUpload();
	}
	function handlePhotoUpload_start(file) {
		var stats = uploader.getStats();
		var currentQueueIndex = stats.successful_uploads + 1;
		var totalPhotosInQueue = stats.successful_uploads + stats.files_queued;
		
		uploaderQueueProgress.html('Uploading ' + currentQueueIndex + ' of ' + totalPhotosInQueue);
		uploaderFileStatus.html(file.name + ': 0%');
	}
	function handlePhotoUpload_progress(file, uploadedBytes, totalBytes) {
		uploaderFileStatus.html(file.name + ': ' + (uploadedBytes / totalBytes * 100).toFixed(0) + '%'); 
	}
	function handlePhotoUpload_error(file) {
		uploaderFileStatus.html('(stopped) Error uploading ' + file.name);
	}
	function handlePhotoUpload_success(file) {
		var stats = uploader.getStats();
		
		refreshPhotos();
		if (!stats.files_queued) {
			uploaderQueueProgress.html('Finished uploading ' + stats.successful_uploads + ' files');
			uploaderFileStatus.html('');
		} else {
			uploaderFileStatus.html(file.name + ': 100%');
			uploader.startUpload();
		}
	}
	
	function refreshPhotos() {
		var postData = {
			action: 'vr_venue_photos_html',
			id: $('#post_ID').val(),
			_ajax_nonce: $('#vr_venue_photos_ajax').val()
		};
		$.post(ajaxurl, postData, function(data) {
			buildingPhotosContainer.html(data).sortable('refresh');
		});
	}
}

function setSelectorTerm(termValue, selector) {
	var existingTerms = [];
	var updatedTermsList, updatedTermsDom = [];

	selector.children().each(function(i, el) {
		existingTerms.push(el.value);
	});
	
	updatedTermsList = $.grep(existingTerms, function(el) {
		return el != termValue;
	});
	updatedTermsList.push($.trim(termValue));
	updatedTermsList.sort();
	
	for (var i = 0; i < updatedTermsList.length; i++) {
		var termOption = document.createElement('option');
		var updatedTerm = updatedTermsList[i];
		
		termOption.value = updatedTerm;
		termOption.text = updatedTerm;
		termOption.selected = updatedTerm == termValue;
		
		updatedTermsDom.push(termOption);
	}
	selector.empty().append(updatedTermsDom);
}

})();