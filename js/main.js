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
    });

    _this.ScrollMagic.init();

  },

  onResize: function() {
    var _this = this;

    _this.ScrollMagic.getColHeights();
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

    _this.cols = {};
    _this.cols.left = $('.scroll-col-left');
    _this.cols.right = $('.scroll-col-right');
    _this.cols.holder = $('.scroll-cols-holder');

    _this.divideDistance = 100;

    _this.scrollDirection = 0;
    _this.cols.left.pos = 0;
    _this.cols.right.pos = 0;

    $('html, body').css({
      'overflow': 'hidden',
    })

    _this.bind();
    _this.getColHeights();
  },

  getColHeights: function() {
    var _this = this;

    _this.cols.left.height = $('.scroll-col-left').height();
    _this.cols.right.height = $('.scroll-col-right').height();
    _this.cols.holder.height = $('.scroll-cols-holder').height();

    _this.cols.left.move = (_this.cols.left.height - _this.cols.holder.height) / _this.divideDistance;
    _this.cols.right.move = (_this.cols.right.height - _this.cols.holder.height) / _this.divideDistance;

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

Site.init();
