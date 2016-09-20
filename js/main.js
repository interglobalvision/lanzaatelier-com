/* jshint browser: true, devel: true, indent: 2, curly: true, eqeqeq: true, futurehostile: true, latedef: true, undef: true, unused: true */
/* global $, jQuery, document, Site, Modernizr */

Site = {
  mobileThreshold: 601,
  init: function() {
    var _this = this;

    $(window).resize(function(){
      _this.onResize();
    });

    $(document).ready(function () {
      _this.Menu.init();
      _this.Layout.init();
      _this.Project.init();
    });

  },

  onResize: function() {
    var _this = this;

  },

  fixWidows: function() {
    // utility class mainly for use on headines to avoid widows [single words on a new line]
    $('.js-fix-widows').each(function(){
      var string = $(this).html();
      string = string.replace(/ ([^ ]*)$/,'&nbsp;$1');
      $(this).html(string);
    });
  },
};

Site.Layout = {
  init: function() {
    var _this = this;

    if ($('.swiper-slide').length) {
      _this.initSwiper();
    }
  },

  initSwiper: function() {
    var _this = this;

    _this.swiper = new Swiper('.swiper-container', {
      loop: true,
      nextButton: '.project-gallery-next',
      prevButton: '.project-gallery-prev',
      pagination: '.project-gallery-pagination',
      paginationType: 'custom',
      spaceBetween: 48,
      setWrapperSize: true,
      paginationCustomRender: function (swiper, current, total) {
        if ($('.project-gallery-pagination').length)
          return '<span id="gallery-index-active">' + current + '</span> / <span id="gallery-index-length">' + total + '</span>';
      },
      onClick: function(swiper) {
        swiper.slideNext();
      },
    });
  },
}

Site.Menu = {
  init: function() {
    var _this = this;

    _this.bindToggle();
  },

  bindToggle: function() {
    $('.mobile-toggle').on('click', function() {
      $('body').toggleClass('menu-active');
    });
  }
};

Site.Project = {
  init: function() {
    var _this = this;

    if ($('body').hasClass('post-type-archive-project')) {
      _this.Archive.init();
    }

    if ($('body').hasClass('single-project')) {
      _this.Single.init();
    }

  },

  Single: {
    init: function() {
      var _this = this;

      _this.bindProjectToggle();
    },

    bindProjectToggle: function() {
      $('.project-content-holder').bind('click', function() {
        $('.project-content-holder').toggleClass('hide');
      });
    }
  },

  Archive: {
    init: function() {
      var _this = this;

      _this.bindTitleHover();
    },

    bindTitleHover: function() {
      $('.archive-project-title').hover( function() {
        // Mouse enter
        $('.project-photos-container[data-id=' + $(this).attr('data-id') + ']').removeClass('hide');
      }, function() {
        // Mouse leave
        $('.project-photos-container[data-id=' + $(this).attr('data-id') + ']').addClass('hide');
      });
    }
  }
};

Site.init();
