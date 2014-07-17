/**
*ui
**/
(function ($, _ben) {
  var toString = Object.prototype.toString;
  $.fn.findUI = function (uiAttr, attrValue) {
    var selector = '[data-ui-' + uiAttr;
    if (attrValue) {
      selector += '="' + attrValue + '"';
    }
    selector += ']';
    return this.find(selector);
  };
  $.findUI = function (uiAttr, attrValue) {
    var selector = '[data-ui-' + uiAttr;
    if (attrValue) {
      selector += '="' + attrValue + '"';
    }
    selector += ']';
    return $(selector);
  };
  $.fn.findMark = function (markName) {
    var selector = '[data-ui-mark="' + markName + '"]';
    return this.find(selector);
  };
  $.fn.uiData = function (attr) {
    return this.attr('data-ui-' + attr);
  };
  var _staticTypeString = {
    obj: '[object Object]'
  };

  _ben.extend({
    processAll: function (rootElement) {
      var els = $(rootElement)
        .find('[data-ui-control]')
        .each(function () {
          var me = $(this), control = me.attr('data-ui-control');
          if (control && _ben[control]) {
            _ben.controlInstance[control] = _ben.controlInstance[control] || [];
            _ben.controlInstance[control].push(new _ben[control](this));
          }
        });
    },
    controlInstance: {}
  });
  _ben.Class.extend('UI', {
    initMark: function () {
      var me = this;
      this.mark = {};
      if (this.box) {
        this.box.findUI('mark')
          .each(function () {
            me.mark[$(this).uiData('mark')] = $(this);
          });
      }
    },
    init: function () {
      var el, options = el_options = {};
      if (!arguments[1]) {
        var argType = $.isPlainObject(arguments[0]);
        if (argType) {
          options = arguments[0];
        }
        else {
          el = arguments[0];
        }
      }
      else {
        el = arguments[0];
        options = arguments[1];
      }
      if (el) {
        this.box = $(el);
        el_options = this.box.attr('data-ui-option');
        el_options = $.parseJSON(el_options);
      }
      this.opt = $.extend({}, options, el_options);
    }
  });

  //�ṩhtml5 data-xxxʽ������ʽ���ýӿ�,����ui�ؼ�����˳��Ϊ,htmlԪ���ϵ����� > �ֶ����õ����� > Ĭ������
  $(function () {
    _ben.processAll($(document.body));
  });
})(jQuery, ue);
