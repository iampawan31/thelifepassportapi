var $ = jQuery;
var emailfilter = /^\w+[\+\.\w-]*@([\w-]+\.)*\w+[\w-]*\.([a-z]{2,4}|\d+)$/i;
var hash;

var screen_md = 840;
var screen_sm = 720;


( function( $ ) {
  feather.replace();
  
  $.fn.equalizeHeights = function(){
    return this.height( Math.max.apply(this, $(this).map(function(i,e){return $(e).height()}).get() ) )
  }
  var showLoading = function() {
    $('#page').append('<div class="spinner__wrapper"><div class="spinner"></div></div>');
  }
  var hideLoading = function() {
    if($('.spinner__wrapper').length > 0) $('.spinner__wrapper').remove();
  }
  
  function scrollToElement(selector, time, verticalOffset, callback) {
    time = typeof(time) != 'undefined' ? time : 500;
    verticalOffset = typeof(verticalOffset) != 'undefined' ? verticalOffset : 0;
    element = $(selector);
    offset = element.offset();
    offsetTop = offset.top + verticalOffset;
    t = ($(window).scrollTop() - offsetTop);
    if (t <= 0) t *= -1
    t = parseInt(t * .5);
    if (t < time) t=time
    if (t > 1500) t=1500
    $('html, body').animate({
      scrollTop: offsetTop
    }, t, 'easeInOutCirc', callback);
  }
  function verticalCenter($el) {
    if($el.length > 0) {
//      alert($(window).height());
      itemPadding = parseInt(($(window).height() - $el.height())/2);
      $el.css({'padding-top':(itemPadding-160)+'px'});
    }
  }
  /*
  Checks the MaxLength of the Textarea
  -----------------------------------------------------
  @prerequisite:	textBox = textarea dom element
  e = textarea event
  length = Max length of characters
  */
  function checkTextAreaMaxLength(textBox, e, parent) {
    var maxLength = parseInt($(textBox).data("length"));
    if (!checkSpecialKeys(e)) { 
      if (textBox.value.length > maxLength - 1) textBox.value = textBox.value.substring(0, maxLength); 
    }
    $(".char-count", parent).html(maxLength - textBox.value.length);
    return true; 
  } 
  
  /*
  Checks if the keyCode pressed is inside special chars
  -------------------------------------------------------
  @prerequisite:	e = e.keyCode object for the key pressed
  */
  function checkSpecialKeys(e) { 
    if (e.keyCode != 8 && e.keyCode != 46 && e.keyCode != 37 && e.keyCode != 38 && e.keyCode != 39 && e.keyCode != 40) 
      return false; 
    else 
      return true; 
  }
  
  //  https://www.codementor.io/lautiamkok/js-tips-creating-a-simple-parallax-scrolling-with-css3-and-jquery-efp9b2spn
  function isInViewport(node, offset) {
    var  offset = offset || 0;
    var rect = node.getBoundingClientRect()
    return (
      (rect.height > 0 || rect.width > 0) &&
      rect.bottom >= 0 &&
      rect.right >= 0 &&
      (rect.top + offset) <= (window.innerHeight || document.documentElement.clientHeight) &&
      rect.left <= (window.innerWidth || document.documentElement.clientWidth)
    )
  }
  
  $.fn.isInViewport = function(offset=0.5) {
    var elementTop = $(this).offset().top;
    var elementBottom = elementTop + $(this).outerHeight();

    var viewportTop = $(window).scrollTop();
    var viewportBottom = viewportTop + $(window).height();
    
    var triggerOffset = parseInt($(window).height() * offset);
    return elementBottom > viewportTop && (elementTop+triggerOffset) < viewportBottom;
  };
  
  function inView(el) {
    var  offset = offset || 0;
    
    return (
      (rect.height > 0 || rect.width > 0) &&
      rect.bottom >= 0 &&
      rect.right >= 0 &&
      (rect.top + offset) <= (window.innerHeight || document.documentElement.clientHeight) &&
      rect.left <= (window.innerWidth || document.documentElement.clientWidth)
    )
  }
  
  
  function copyEmailToClipboard(str) {
    var $temp = $("<input>");
    $("body").append($temp);
    $temp.val(str).select();
    document.execCommand("copy");
    $temp.remove();
  }
  
  function loadWindow() {}
  function scrollWindow() {}
  function resizeWindow() {}
  
  
  var body    = $( 'body' ),
    _window = $( window );

  
  
  ( function() {
    loadWindow();
    $(window).scroll(scrollWindow);
    $(window).resize(resizeWindow);
    
    
//    verticalCenter($('.question-header'));
    
//    $("#secondary").stick_in_parent();
    
    if($('[data-bgimg]').length > 0) {
      $('[data-bgimg]').each(function() {
        bgimg = $(this).attr('data-bgimg');
        $(this).css({
          'background-image': 'url('+bgimg+')'
        });
      });
    }
    
    if($('.header-userinfo').length > 0) {
      $('.header-userinfo').each(function() {
        var $wrapper = $(this);
        var $toggleBtn = $('.userinfo', $wrapper);
        var $menu = $('ul', $wrapper);
        $toggleBtn.click(function(e) {
          e.preventDefault();
          $menu.stop().slideToggle();
          $toggleBtn.toggleClass('menu--open');
        });
      });
    }
    
    $('.section').each(function() {
      var $wrapper = $(this);
      var $formWrapper = $('.form-wrapper', $wrapper);
      $('.btn-editinfo').click(function(e) {
        e.preventDefault();
//        e.stopPropagation();
        $formWrapper.removeClass('hidden');
      });
    });
    
    
    $('.link-toogle').live('click', function(e) {
      e.preventDefault();
      $('#'+$(this).data('toggle')).slideDown();
      $(this).hide();
    });
    
    
    $('.toggle-fields').live('change', function() {
      var $item = $(this);
      var $toggleFields = $('#'+$item.data('toggle-fields'));
      if($item.prop('checked')) {
        $toggleFields.slideDown(400, function() {$toggleFields.removeClass('hidden')});
      } else {
        $toggleFields.slideUp(400, function() {$toggleFields.addClass('hidden')});
      }
    });
    
    
    $('.add-anohter-field .btn-add a').live('click', function(e) {
      e.preventDefault();
      var $btnAdd = $(this);
      var $wrapper = $btnAdd.parents('.add-anohter-field');
      var $field = $('.hidden:eq(0)', $wrapper)
      $field.slideDown(function(){$field.removeClass('hidden')});
    });
    $('.add-anohter-field .btn-remove').live('click', function(e) {
      e.preventDefault();
      var $parent = $(this).parents('.field-wrapper');
      $parent.slideUp(function() {
        $parent.addClass('hidden');
      });
    });
    
    
    $('#relationship').on("change", function (e) {
      if($(this).val() == 'other') {
        $('#relatiionship_other').slideDown(400, function() {
          $(this).focus();
        });
      } else {
        $('#relatiionship_other').slideUp();
      }
    });
    
    $('#staff_member_type').on("change", function (e) {
      if($(this).val().replace(/^\s*|\s*$/g,"") !== "") {
        if($(this).val() == '0') {
            $('#staff_type_other').slideDown(400, function() {
            $(this).focus();
          });
        } else {
          $('#staff_type_other').slideUp();
        }
        $('.staff-members-fields').slideDown();
        
      } else {
        $('.staff-members-fields').slideUp();
      }
    });
    
    $('.group').each(function() {
      var $wrapper = $(this);
      var $header = $('.group__header', $wrapper);
      var $content = $('.group__content', $wrapper);
      $header.click(function(e) {
        e.preventDefault();
        $content.slideToggle();
      });
    })
    
    
    if($('.input-file-wrapper').length > 0) {
      $('.input-file-wrapper').each(function() {
        var $wrapper = $(this);
        var $fileInput = $('input[type="file"]', $wrapper);
        var validFileExtensions = ["jpg", "jpeg", "bmp", "gif", "png", "tiff", 'pdf'];
        var $fileName = $('.input-file-name');
        $fileInput.change(function(e){
          $item = $(this);
          var fileName = e.target.files[0].name;
          if(fileName!==''){
            var ext = (/[.]/.exec(fileName)) ? /[^.]+$/.exec(fileName) : undefined;
            if(jQuery.inArray(ext.toString(), validFileExtensions)==-1) {
              alert('Please make sure your file is in pdf or image format');
            } else {
              $('span', $fileName).empty().append(fileName);
              $fileName.fadeIn(300);
            }
          }
        });
        $('.removefile', $fileName).click(function(e) {
          e.preventDefault();
          $fileInput.wrap('<form>').closest('form').get(0).reset();
          $fileInput.unwrap();
          $fileName.fadeOut(300, function() {
            $('span', $fileName).empty();
          });
        });
        
      });
    }
    
    // Code from the related question. Used the answer from @Markus
//    $.datepicker._updateDatepicker_original = $.datepicker._updateDatepicker;
//    $.datepicker._updateDatepicker = function(inst) {
//    $.datepicker._updateDatepicker_original(inst);
//    var afterShow = this._get(inst, 'afterShow');
//    if (afterShow)
//        afterShow.apply((inst.input ? inst.input[0] : null));  // trigger custom callback
//    }
//    https://stackoverflow.com/questions/25959480/initialize-select2-dropdown-on-jquery-datepicker
//    $( ".field-datepicker" ).datepicker({
//      dateFormat: "DD, MM d, yy",
//      dayNamesMin: ['S', 'M', 'T', 'W', 'TH', 'F', 'S'],
//      showOtherMonths: true,
//      selectOtherMonths: false,
//      changeMonth: true,
//      changeYear: true, // Add the ability to select the year
////      yearRange: '1930:20', // Set the year range selection from 1930 to 2000
////      afterShow: function() {
////            $(".ui-datepicker select").select2();
////        },
//      minDate: new Date()
//    });

    $( ".field-datepicker" ).datepicker({
      dateFormat: "dd/mm/yy",
      dayNamesMin: ['S', 'M', 'T', 'W', 'TH', 'F', 'S'],
      showOtherMonths: true,
      selectOtherMonths: false,
      changeMonth: true,
      changeYear: true,
    });

    $('.input-mobile').mask('(000) 000-0000');
    
    autosize(document.querySelectorAll('textarea'));
    if($(".char-textarea").length > 0) {
      $(".char-textarea").each(function() {
        var $item = $(this);
        var parent = $(this).parents('.field-group');
        var maxLength = parseInt($item.data("length"));
        $(".char-count", parent).html(maxLength - $item.val().length);
        $item.on("keyup",function(event){
          checkTextAreaMaxLength(this,event,parent);
        });
      });
    }
    
    if($('.input-numeric').length > 0) {
      $(".input-numeric").on("keypress keyup blur",function (event) {    
        $(this).val($(this).val().replace(/[^\d].+/, ""));
        if ((event.which < 48 || event.which > 57)) {
          event.preventDefault();
        }
      });
    }
    
    $(".input-float").on("keypress keyup blur",function (event) {
      $(this).val($(this).val().replace(/[^0-9\.]/g,''));
      if ((event.which != 46 || $(this).val().indexOf('.') != -1) && (event.which < 48 || event.which > 57)) {
        event.preventDefault();
      }
    });
    
    $('.input-password').password({
      shortPass: '<span class="weak">The password is too short</span>',
      badPass: '<span class="weak">Weak; try combining letters & numbers</span>',
      goodPass: '<span class="medium">Medium; try using special charecters</span>',
      strongPass: '<span class="strong">Strong password</span>',
      containsUsername: '<span class="weak">The password contains the username</span>',
      enterPass: 'Type your password',
      showPercent: false,
      showText: true, // shows the text tips
      animate: true, // whether or not to animate the progress bar on input blur/focus
      animateSpeed: 'fast', // the above animation speed
      username: false, // select the username field (selector or jQuery instance) for better password checks
      usernamePartialMatch: true, // whether to check for username partials
      minimumLength: 4 // minimum password length (below this threshold, the score is 0)
    });
    

    $('.custom-select').select2({
//      minimumResultsForSearch: -1,
      width: 'resolve'
    });
    
    if($('.error-select').length > 0) {
      $('.error-select').each(function() {
        $('.select2-selection', $(this)).addClass('input-error');
      });
    }
    
    if($('.error-radio').length > 0) {
      $('.error-radio').each(function() {
        $('input', $(this)).parents('.form-group-radio').addClass('has-error');
      });
    }
    if($('.error-checkbox').length > 0) {
      $('.error-checkbox').each(function() {
        $('input', $(this)).parents('.form-group-checkbox').addClass('has-error');
      });
    }
    
//    if($('.link-toogle').length > 0) {
//      $('.link-toogle').each(function() {
//        var $item = $(this);
//        $item.click(function(e) {
//          e.preventDefault();
//          $('#'+$item.data('toggle')).stop().slideToggle();
//        });
//      });
//    }
//    
//    
//    if($('.dashboard-lists').length > 0) {
//      $('.dashboard-lists').each(function() {
//        var $wrapper = $(this);
//        var $items = $('.section', $wrapper);
//        $items.each(function() {
//          var $item = $(this);
//          var $itemHeader = $('.section__header', $item);
//          var $itemContent = $('.section__content', $item);
//          var $actionButtons = $('.action-buttons', $itemHeader);
//          var $btnShowContent = $('.btn-show-content', $itemHeader);
//          var $btnCloseContent = $('.btn-close-content', $itemHeader);
//          $btnShowContent.click(function(e) {
//            e.preventDefault();
//            e.stopPropagation();
//            $actionButtons.hide();
//            $btnCloseContent.show();
//            $itemContent.slideDown();
//          });
//          $btnCloseContent.click(function(e) {
//            e.preventDefault();
//            e.stopPropagation();
//            $itemContent.slideUp();
//            $actionButtons.show();
//            $btnCloseContent.hide();
//          });
//        });
//      });
//    }
    

    
    
    
    $('.custom-form1').each(function() {
      var $form = $(this);
      var $section = $form.parents('.section');
      var $wrapper = $('.section__content', $section);
      $form.submit(function() {
        isValid = true;
        var err_msg;
        var err_cnt = 0;
        
        
        var $errorMessages = $('.error-message', $wrapper);
        $errorMessages.empty().hide();
        
        var $successMessage = $('.success-message', $wrapper);
        $successMessage.hide();
//        $('.success-message__text', $successMessage).empty();

        $('.input-error', $form).removeClass('input-error');
        $('.has-error', $form).removeClass('has-error');
        err_msg = '<ul>';
        if(isValid) {
          $('.field-input.required', $form).each(function() {
            if($(this).parents('.hidden').length > 0) return;
            if($(this).val().replace(/^\s*|\s*$/g,"")=="") {
              $(this).addClass('input-error');
              isValid=false;
              if(!($(this).data('error'))) {
                err_msg += '<li>'+$('[for="'+$(this).attr('id')+'"]').text()+' is required.</li>';
              } else {
                err_msg += '<li>'+$(this).data('error')+'</li>';
              }
              err_cnt++;
            }
          });
        
          $('.custom-select.required', $form).each(function() {
            if($(this).parents('.hidden').length > 0) return;
            if($(this).val().replace(/^\s*|\s*$/g,"")=="") {
              $parent = $(this).parents('.field-group');
              $('.select2-selection', $parent).addClass('input-error');
              isValid=false;
              if(!($(this).data('error'))) {
                err_msg += '<li>'+$('[for="'+$(this).attr('id')+'"]').text()+' is required.</li>';
              } else {
                err_msg += '<li>'+$(this).data('error')+'</li>';
              }
              err_cnt++;
            }
          });
        }

        if(isValid) { 
          $('.field-input.email', $form).each(function() {
            if($(this).val().replace(/^\s*|\s*$/g,"")=="") return;
            if(isValid && emailfilter.test($(this).val())==false) {
              $(this).addClass('input-error');
              if(!($(this).data('error'))) {
                err_msg += '<li>'+$('[for="'+$(this).attr('id')+'"]').text()+' not a valid email address.</li>';
              } else {
                err_msg += '<li>'+$('input[name^=accept_terms]').data('error')+'</li>';
              }
              err_cnt++;
              isValid = false;
            }
          });
        }
        err_msg += '</ul>';

        if(!(isValid)) {
          err_msg = '<div class="error-header">Please read and correct specific error item below:</div><div class="error-content">'+err_msg+'</div>';
          $errorMessages.html(err_msg).show();
          scrollToElement($errorMessages, 800, -100);
        } else {
          $('.success-message__text', $successMessage).empty().append("Information has been updated successfully.");
          $successMessage.show();
          if($form.attr('id')==='frmSpouseDetails') {
            $('.spouse-details').removeClass('hidden');
            $('.btn-show-content', $section).text('Manage');
            $('.form-wrapper', $wrapper).addClass('has-data hidden');
            scrollToElement($successMessage, 800, -100);
          } else {
            if($('.section-data').length > 0) {
              $('.section-data').fadeIn();
              $('.form-wrapper').fadeOut();
  //            scrollToElement($('.section-data'), 800, -100);
            } else {
              scrollToElement($successMessage, 800, -100);
            }
          }
          dismissMessage = setInterval(function() {
            $successMessage.fadeOut(1000, function() {
              $('.success-message__text', $successMessage).empty();
            });
            clearInterval(dismissMessage);
          },  2000);
        }
        return false;
      });
    });
    
    if($('.delete-item').length > 0) {
      $('.delete-item').each(function() {
        var $btn = $(this);
        $btn.click(function(e) {
          e.preventDefault();
          e.stopPropagation();
          
          var $modal = $('#modalDeleteItem');
          $modal.modal('show');
          
          $modal.on('click', '#delete', function(e) {
            $('body').showLoading();
            //do ajax to to remove application request
            
            var timer = setInterval(function() {
              $('body').hideLoading();
              clearTimeout(timer);
            }, 2000);
          });
        });
      });
    }
    
    
    $('#questions-wrapper').each(function() {
      var $wrapper = (this);
      $('.custom-form', $wrapper).live('submit', function() {
        var $form = $(this);
        $('#page').showLoading();
        var timer = setInterval(function() {
          $('#page').hideLoading();
          gotoNext($form);
          clearTimeout(timer);
        }, 500);
        return false;
      });
      
      
      $('.btn-skip', $wrapper).live('click', function(e) {
        e.preventDefault();
        console.log("skip");
      });
      $('.btn-no', $wrapper).live('click', function(e) {
        e.preventDefault();
        console.log("Say No");
        $('body').showLoading();
        var $item = $(this);
        var timer = setInterval(function() {
          $('body').hideLoading();
          gotoNext($item);
          clearTimeout(timer);
        }, 500);
      });
      $('.btn-yes', $wrapper).live('click', function(e) {
        e.preventDefault();
        console.log("Say Yes");
        showcontent($(this));
      });
      var gotoNext = function($el) {
        $parent = $el.parents('.question-item');
        var $newQuestion = $('<div class="question-item">');
        var nextPageURL = $('.question-item__content', $parent).data('nextpage');
        
        $newQuestion.empty().load("questions/"+nextPageURL);
        $($wrapper).append($newQuestion);
        $parent.addClass('closed');
        feather.replace();
      };
      
      var showcontent = function($el) {
        $parent = $el.parents('.question-item');
        var $content = $('.question-content', $parent);
        var $yesno = $('.yesno', $parent);
        $yesno.slideUp();
        $parent.addClass('open');
        $content.stop().slideDown();
        feather.replace();
        $('.custom-select', $content).select2({
          width: 'resolve'
        });
      };
    });
    
	} )();
} )( jQuery );

function get_hostname(url) {
  var m = ((url||'')+'').match(/^https?:\/\/[^/]+/);
  return m ? m[0] : null;
}