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
  },

  Archive: {
    init: function() {
      var _this = this;

      _this.bindTitleHover();
    },

    bindTitleHover: function() {
      $('.archive-project-title').hover(
        function() {
          $('img[data-id=' + $(this).attr('data-id') + ']').show();
        },
        function() {
          $('img[data-id=' + $(this).attr('data-id') + ']').hide();
        }
      );
    }
  }
};

Site.init();