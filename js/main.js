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

    _this.cols = $('.scroll-col');
    _this.moveBy = 25;
    _this.scrollPosition = 0;

    _this.setRightCol();
    _this.bind();
  },

  bind: function() {
    var _this = this;

    // Bind scroll in front page sections
    $('.scroll-col').on('mousewheel', $.proxy( _this.scroll, _this) );

    
    $('.scroll-col').on('scroll', function(event) { 
      $.each(_this.cols, function(key,val) {
        _this.scroll();
      });

      requestAnimationFrame(function() {
        $.each(_this.cols, function(key,val) {
          $(val).css('transform', 'translate(0px, ' + _this.scrollPosition + 'px)');
        });
      });

    });
  },

  setRightCol: function() {
    
  }

  scroll: function() {
    var _this = this;
    var maxTop = 0;
    var minTop = _this.getMaxTop();

    _this.scrollPosition -= _this.moveBy;
    
    if (_this.scrollPosition > maxTop && _this.moveBy < 0) {
      _this.scrollPosition = maxTop;
    }

    _this.updateScroll();

  },

  getMaxTop: function() {
    var _this = this;
    var heights = [];
    
    $.each(_this.cols, function(key,val) {
      heights.push($(val).height());
    });

    return Math.max.apply(null, heights);
  },

  updateScroll: function(event) {
    var _this = this;

    $.each(_this.cols, function(key,val) {
      $(val).css('transform', 'translate(0px, ' + _this.scrollPosition + 'px)');
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
