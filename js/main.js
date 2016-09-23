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
      _this.ScrollMagic.init();
    });

  },

  onResize: function() {
    var _this = this;

    $('body').removeClass('menu-active');

    if ($('body').hasClass('home')) {
      _this.ScrollMagic.getColHeights();
    }
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

Site.ScrollMagic = {
  init: function() {
    var _this = this;

    if ($('body').hasClass('home')) {
      // Higher means slower
      _this.speedLimit = 4000;

      _this.cols = {};
      _this.cols.left = $('.scroll-col-left');
      _this.cols.right = $('.scroll-col-right');
      _this.cols.holder = $('.scroll-cols-holder');

      _this.scrollDirection = 0;
      _this.cols.left.pos = 0;
      _this.cols.right.pos = 0;

      // This is to avoind 'elastic' scroll on macOS and iOS
      $('html, body').css({
        'overflow': 'hidden',
      });

      _this.bind();

      _this.getColHeights();
    }
  },

  getColHeights: function() {
    var _this = this;

    _this.cols.left.height = $('.scroll-col-left').height();
    _this.cols.right.height = $('.scroll-col-right').height();
    _this.cols.holder.height = $('.scroll-cols-holder').height();

    _this.cols.left.max = -(_this.cols.left.height - _this.cols.holder.height);
    _this.cols.right.max = (_this.cols.right.height - _this.cols.holder.height);

    _this.updateScroll();
  },

  bind: function() {
    var _this = this;

    // Bind scroll in front page sections
    $(document).on('mousewheel', $.proxy( _this.scroll, _this) );

  },

  scroll: function(event) {
    var _this = this;

    _this.scrollDirection = event.deltaY;
    _this.scrollSpeed = _this.speedLimit / Math.abs(event.deltaY);

    _this.cols.left.move = (_this.cols.left.height - _this.cols.holder.height) / _this.scrollSpeed;
    _this.cols.right.move = (_this.cols.right.height - _this.cols.holder.height) / _this.scrollSpeed;

    if(_this.scrollDirection > 0) {
      _this.cols.left.pos = _this.cols.left.pos + _this.cols.left.move;
      _this.cols.right.pos = _this.cols.right.pos - _this.cols.right.move;
    } else {
      _this.cols.left.pos = _this.cols.left.pos - _this.cols.left.move;
      _this.cols.right.pos = _this.cols.right.pos + _this.cols.right.move;
    }

    _this.updateScroll();
  },

  checkScrollPos: function() {
    var _this = this; 

    if (_this.cols.left.pos > 0 || _this.cols.left.height <  _this.cols.holder.height) {
      _this.cols.left.pos = 0;
    } else if (_this.cols.left.pos < _this.cols.left.max) {
      _this.cols.left.pos = _this.cols.left.max;
    }

    if (_this.cols.right.pos < 0 || _this.cols.right.height <  _this.cols.holder.height) {
      _this.cols.right.pos = 0;
    } else if (_this.cols.right.pos > _this.cols.right.max) {
      _this.cols.right.pos = _this.cols.right.max;
    }
  },

  updateScroll: function() {
    var _this = this;

    _this.checkScrollPos();

    requestAnimationFrame(function() {

      _this.cols.left.css('transform', 'translateY(' + _this.cols.left.pos + 'px)');

      _this.cols.right.css('transform', 'translateY(' + _this.cols.right.pos + 'px)');

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
      $('.project-content-holder').bind('click', function(event) {
        if (event.target.nodeName !== 'A') {
          $('.project-content-holder').toggleClass('hide');
        }
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
