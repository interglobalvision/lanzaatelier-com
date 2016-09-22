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

    _this.moveBy = 1;
    _this.scrollPosition = 0;

    _this.setRightCol();
    _this.bind();
  },

  bind: function() {
    var _this = this;

    // Bind scroll in front page sections
    $('.front-page-section').on('mousewheel', $.proxy( _this.scroll, _this) );

  },

  setRightCol: function() {
    var _this = this;

    var headerHeight = $('#header').outerHeight();
    var footerHeight = $('#footer').outerHeight();

    _this.rightColOffset = 100 - ((window.innerHeight - headerHeight * 2 - footerHeight * 2) * 100 / _this.cols.right.outerHeight());
    _this.cols.right.css({
      'transform': 'translate(0px, -100%)'
    });
  },

  scroll: function(event) {
    var _this = this;

    var maxTop = 0;
    var minTop = -1 * _this.rightColOffset; // _this.getMaxTop(); // TODO: calc offset
    var scrollDirection = event.deltaY;

    if(scrollDirection > 0) {
      _this.scrollPosition += _this.moveBy;
    } else {
      _this.scrollPosition -= _this.moveBy;
    }

    // Reach bottom (left)
    if (_this.scrollPosition <= minTop) {
      _this.scrollPosition = minTop;
    }

    // Reach bottom (right)
    if (_this.scrollPosition >= maxTop) {
      _this.scrollPosition = maxTop;
    }

    console.log('scrollPosition', _this.scrollPosition);

    _this.updateScroll();

  },

  getMaxTop: function() {

  },

  updateScroll: function() {
    var _this = this;

    requestAnimationFrame(function() {
      _this.cols.left.css('transform', 'translate(0px, ' + _this.scrollPosition + '%)');

      _this.cols.right.css('transform', 'translate(0px, ' +  (100 + _this.scrollPosition) * -1 + '%)');

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
