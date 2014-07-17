/**
*slideshow
**/
(function ($, _ben) {
    //�ṩjquery���ýӿ�
    $.fn.farmerSlide = function (options) {
        this.each(function (i, n) {
            new _ben.Slide(n, options)
        });
    };
    var isIE = !!window.ActiveXObject;
    var isIE6 = isIE && !window.XMLHttpRequest;
    _ben.UI.extend('Slide', {
        //��ʼ��һЩ����
        init: function (el, options) {
            this.base(el, options);
            this.opt = $.extend({}, _ben.Slide.defaultOptions, this.opt);
            this.currentIndex = 0;
            this.isAnimating = false;
            //ҳ����û��ģ��,��ʹ��js�����õ�ģ��
            if (!this.box.findMark('imageContainer')[0]) {
                this.box.append(this.opt.template);
            }
            this.opt.boxWidth = parseFloat(this.box.css('width'));
            this.opt.boxHeight = parseFloat(this.box.css('height'));
            this.initMark();
            this.setup();
        },
        //��װ������
        setup: function () {
            var me = this;
            me.mark.imageContainer.width(me.opt.boxWidth).height(me.opt.boxHeight);
            me.mark.data && me.mark.data.hide();
            me.loadData();
            me.initThumbs();
            me.start();
            if (me.mark.loading && !me.data[0].img) me.mark.loading.hide();
            //�ȼ��ص�һ��ͼƬ����Ϻ���Ԥ����ʣ�µ�����ͼƬ
            $(new Image()).load(function () {
                me.data[0].loaded = true;
                me.preDownLoadImage.call(me);
            }).attr('src', me.data[0].img);
        },
        //���ػõ�Ƭ����(������ͼƬ���ݱ���),Ŀǰֻ�д�html��ǩ�л�ȡ,�����������������ַ�ʽ
        loadData: function () {
            var me = this;
            me.data = [];
            if (me.mark.data) {
                me.mark.data.find('li').each(function () {
                    var dataEl = $(this), _data = {}, imgEl = dataEl.findUI('data', 'img'),
                      imgElAniType = imgEl.uiData('slide-animate'), thumbImg = dataEl.findUI('data', 'thumb'),
                        descEl = dataEl.findUI('data', 'desc'), linkEl = dataEl.findUI("data", "link"), titleEl = dataEl.findUI("data", "title");
                    thumbImg = thumbImg || imgEl;
                    _data.img = imgEl.attr('data-src');
                    _data.thumbImg = thumbImg.attr('data-src');
                    _data.desc = descEl.text() || '';
                    _data.title = titleEl.text() || '';
                    _data.link = linkEl.attr('href') || '';
                    me.data.push(_data);
                });
            }
            else if (me.opt.data) {
                me.data = me.opt.data;
            }
            if (me.randomShow) {
                me.data.sort(function (a, b) { return Math.random() - 0.5; });
            }
            me.total = me.data.length;
        },
        preDownLoadImage: function () {
            var me = this, img = new Image(), index = 0;
            $.each(me.data, function (i, n) {
                $(img).load(function () {
                    me.data[i].loaded = true;
                }).attr('src', this.img);
            });
        },
        pushData: function () {
        },
        //ͼƬ������Ϻ�,��ʼ���и�����
        start: function () {
            var me = this;
            me.setCurrentImage();
            //me.mark.tool && me.mark.tool.fadeIn(500);
            me.bindAction();
            me.autoToggle();
        },
        _setCurrentImage: function (index, fn) {
            var me = this, _data = me.data[index];
            me.mark.loading && me.mark.loading.hide();
            me.mark.img.attr('src', _data.img);
            me.mark.title && me.mark.title.text(_data.title);
            me.mark.desc && me.mark.desc.text(_data.desc);
            if (me.mark.link) {
                me.mark.link.attr('href', _data.link);
                me.mark.title && me.mark.title.attr('href', _data.link);
                me.mark.desc && me.mark.desc.attr('href', _data.link);
            }
            me.onPageLoaded(index);
            fn && fn();
        },
        //���ݲ������õ�ǰͼƬ,û�в�����ʹ�õ�ǰ���õ�ͼƬ
        setCurrentImage: function (index, fn) {
            var me = this;
            index = index === undefined ? me.currentIndex : index;
            me.currentIndex = index;
            var _data = me.data[index];
            if (_data.loaded) {
                me._setCurrentImage(index, fn);
            }
            else {
                me.mark.loading && me.mark.loading.show();
                $(new Image()).load(function () {
                    _data.loaded = true;
                    me._setCurrentImage(index, fn);
                }).attr('src', _data.img);
            }
        },
        autoToggle: function () {
            var me = this;
            if (!me.opt.autoPlay) return;
            me.thumbDirect = 'right';
            me.clearTimer();
            me.timer = setTimeout(function () {
                me.isAuto = true;
                me.nextPage();
            }, me.opt.interval);
        },
        //��ʼ��������
        initThumbs: function () {
            var me = this;
            var thumbs = '';
            $.each(me.data, function (i, _data) {
                thumbs += me.getThumbItem(i);
            });
            me.mark.thumbs.empty();
            me.mark.thumbs.append(thumbs);
            var thumbItems = me.mark.thumbs.find('.focus-thumb-item');
            me.thumbItemWidth = thumbItems.outerWidth(true);
            //�ɼ�Ԥ��������
            me.totalVisableThumb = Math.ceil(me.mark.thumbsbox.innerWidth() / me.thumbItemWidth);
            me.noRepeat = me.totalVisableThumb >= me.total;
            if (!me.noRepeat) {
                me.mark.thumbsClone = me.mark.thumbs.clone();
                me.mark.thumbs.after(me.mark.thumbsClone);
            }
            //����Ԥ�����
            me.getThumbGrid();
        },
        getThumbGrid: function () {
            var me = this;
            me.mark.thumbGrid = $('<div class="focus-thumb-grid"></div>');
            me.mark.thumbsbox.append(me.mark.thumbGrid);
        },
        getThumbItem: function (index) {
            var me = this, _data = me.data[index];
            var thumb = '<p class="focus-thumb-item" data-ui-thumb-item><a href="javascript://"><img data-ui-rel="' + index + '" src="' + _data.thumbImg + '"/></a></p>';
            return thumb;
        },
        onThumbAniFinish: function (index) {
            var me = this;
            var currentThumb = me.mark.thumbs.find('.focus-thumb-item:eq(' + index + ')');
            currentThumb.addClass('current');
            if (!me.noRepeat) {
                currentThumb = me.mark.thumbsClone.find('.focus-thumb-item:eq(' + index + ')');
                currentThumb.addClass('current');
            }
            me.autoToggle();
            me.isAnimating = false;
        },
        setCurrentThumb: function (index) {
            this.isAnimating = true;
            var me = this, index = parseInt(index);
            var currentMarginLeft = parseInt(me.mark.thumbs.css('marginLeft')),
              targetMarginLeft = -index * me.thumbItemWidth;
            var leftIndex = Math.abs(currentMarginLeft / me.thumbItemWidth);
            if (!me.isAuto) {
                for (var i = 0; i < me.totalVisableThumb; i++) {
                    var visibleThumbIndex = (leftIndex * 1 + i) % (me.total);
                    if (index === visibleThumbIndex) {
                        var gridLeft = parseInt(me.mark.thumbGrid.css('left'));
                        var targetGridLeft = i * me.thumbItemWidth;
                        if (gridLeft != targetGridLeft) {
                            me.mark.thumbGrid.animate({ 'left': targetGridLeft }, me.opt.thumbAniInterval, '');
                        }
                        me.box.find('.focus-thumb-item').removeClass('current');
                        me.onThumbAniFinish.call(me, index);
                        return
                    }
                }
            }
            if (currentMarginLeft != targetMarginLeft) {
                if (me.thumbDirect == 'right') {
                    //�����һԤ�����ѹ�������Ұ,������
                    var maxMarginLeft = -me.total * me.thumbItemWidth;
                    if (currentMarginLeft == maxMarginLeft) {
                        me.mark.thumbs.css('margin-left', 0);
                        currentMarginLeft = targetMarginLeft = 0;
                    }
                    targetMarginLeft = currentMarginLeft - me.thumbItemWidth;
                }
                else if (me.thumbDirect == 'left') {
                    if (index === me.total - 1) {
                        currentMarginLeft = -me.total * me.thumbItemWidth
                        me.mark.thumbs.css('margin-left', currentMarginLeft);
                    }
                    targetMarginLeft = currentMarginLeft + me.thumbItemWidth;
                }
                me.box.find('.focus-thumb-item').removeClass('current');
                me.mark.thumbs.animate({ 'margin-left': targetMarginLeft }, me.thumbAniInterval, '', function () {
                    me.onThumbAniFinish.call(me, index);
                });
            }
            else {
                me.onThumbAniFinish(index);
            }
        },
        onPageLoaded: function (index) {
            this.setCurrentThumb(index);
        },
        //��ת��ָ��ҳ��,��������ò��Ŷ���
        goToPage: function (index) {
            var me = this;
            if (index >= 0 && !me.isAnimating && index < me.total) {
                var _data = me.data[me.currentIndex], _aniType = _data.aniType || me.opt.defaultAni;
                if (me.opt.fuckIe6 && isIE6) _aniType = '';
                var oldIndex = me.currentIndex;
                me.setCurrentImage(index, function () {
                    if (me.animateLists[_aniType]) {
                        me.box.find('.ben-slide-clonebox').remove();
                        me.animateLists[_aniType].call(me, oldIndex, index);
                    }
                });
            }
        },
        //��ת����һҳ
        nextPage: function () {
            var me = this, index = me.currentIndex * 1 + 1;
            if (index >= me.total) index = 0;
            me.goToPage(index);
        },
        //��ת����һҳ
        prevPage: function () {
            var me = this, index = me.currentIndex - 1;
            if (index < 0) index = me.total - 1;
            me.goToPage(index);
        },
        getBoxClone: function (index) {
            var _data = this.data[index];
            var box_clone = $('<div class="ben-slide-clonebox"><a href="' + _data.link + '" target="_self"><img src="' + _data.img + '" /></a></div>');
            return box_clone;
        },
        appendBoxClone: function (boxClone) {
            this.mark.imageContainer.append(boxClone);
        },
        onAnimateBegin: function (oldIndex, nextIndex) {
            var me = this;
            me.clearTimer();
            //me.isAnimating = true;
        },
        onAnimateFinish: function (oldIndex, nextIndex) {
            var me = this;
            //me.isAnimating = false;
            //me.timer = setTimeout(function () {
            me.box.find('.ben-slide-clonebox').remove();
            me.autoToggle();
            //}, time);
        },
        clearTimer: function () {
            clearTimeout(this.timer);
            clearTimeout(this.thumbTimer);
        },
        //��htmlԪ�ذ󶨻õ�Ƭ����
        bindAction: function () {
            var me = this;
            if (me.mark.next) {
                me.mark.next.click(function () {
                    me.isAuto = false;
                    me.thumbDirect = 'right';
                    me.nextPage();
                });
            }
            if (me.mark.prev) {
                me.mark.prev.click(function () {
                    me.isAuto = false;
                    me.thumbDirect = 'left';
                    me.prevPage();
                });
            }
            if (me.mark.thumbs) {
                me.mark.thumbsbox.click(function (e) {
                    var index = $(e.target).uiData('rel');
                    if (index !== undefined && index !== null) {
                        me.thumbDirect = 'right';
                        me.isAuto = false;
                        me.goToPage(index);
                    }
                });
            }
        },
        //�����б�,Ҫ��չ�ɼ̳в����ش��б�
        animateLists: {
            random: function (oldIndex, nextIndex) {
                var aniArr = ['slideRight','slideLeft', 'lineRight', 'lineTop', 'lineLeft', 'lineBottom', 'fadeIn'];
                var index = Math.floor(Math.random() * 7);
                this.animateLists[aniArr[index]].call(this, oldIndex, nextIndex);
            },
            slideLeft: function (oldIndex, nextIndex) {
                this.animateLists.line.call(this, oldIndex, nextIndex, { direction: 'left', total: 1 });
            },
            slideRight: function (oldIndex, nextIndex) {
                this.animateLists.line.call(this, oldIndex, nextIndex, { direction: 'right', total: 1 });
            },
            lineRight: function (oldIndex, nextIndex) {
                this.animateLists.line.call(this, oldIndex, nextIndex, { direction: 'right', total: 1 });
            },
            lineTop: function (oldIndex, nextIndex) {
                this.animateLists.line.call(this, oldIndex, nextIndex, { direction: 'top', total: 10 });
            },
            lineLeft: function (oldIndex, nextIndex) {
                this.animateLists.line.call(this, oldIndex, nextIndex, { direction: 'left', total: 10 });
            },
            lineBottom: function (oldIndex, nextIndex) {
                this.animateLists.line.call(this, oldIndex, nextIndex, { direction: 'bottom', total: 10 });
            },
            line: function (oldIndex, nextIndex, options) {
                var me = this, width = me.opt.boxWidth, height = me.opt.boxHeight,
                currentImg = me.data[oldIndex].img,
                nextImg = me.data[nextIndex].img;
                me.onAnimateBegin(oldIndex, nextIndex);
                var options = $.extend({}, { direction: 'top', delayType: 'quence', total: 5 }, options || {});
                var easing = this.opt.easing ? this.opt.easing : '';
                var time = 1200 / me.opt.animateSpeed;
                var total = options.total;
                for (i = 0; i < total; i++) {
                    switch (options.direction) {
                        case 'right':

                            var cloneWidth = width;
                            var cloneHeight = Math.ceil(height / total);

                            var _itopc = (cloneHeight * i);
                            var _ileftc = 0;
                            var _ftopc = _itopc;
                            var _fleftc = cloneWidth;

                            var _itopn = _itopc;
                            var _ileftn = -_fleftc;
                            var _ftopn = _itopc;
                            var _fleftn = 0;

                            var _vtop_image = -_itopc;
                            var _vleft_image = 0;
                            break;
                        case 'top':
                            var cloneWidth = Math.ceil(this.opt.boxWidth / total);
                            var cloneHeight = this.opt.boxHeight;

                            var _itopc = 0;
                            var _ileftc = (cloneWidth * i);
                            var _ftopc = -cloneHeight;
                            var _fleftc = _ileftc;

                            var _itopn = cloneHeight;
                            var _ileftn = _ileftc;
                            var _ftopn = 0;
                            var _fleftn = _ileftc;

                            var _vtop_image = 0;
                            var _vleft_image = -_ileftc;
                            break;
                        case 'left':
                            var cloneWidth = this.opt.boxWidth;
                            var cloneHeight = Math.ceil(this.opt.boxHeight / total);

                            var _itopc = (cloneHeight * i);
                            var _ileftc = 0;
                            var _ftopc = _itopc;
                            var _fleftc = -cloneWidth;

                            var _itopn = _itopc;
                            var _ileftn = -_fleftc;
                            var _ftopn = _itopc;
                            var _fleftn = 0;

                            var _vtop_image = -_itopc;
                            var _vleft_image = 0;
                            break;
                        case 'bottom':
                            var cloneWidth = Math.ceil(this.opt.boxWidth / total);
                            var cloneHeight = this.opt.boxHeight;

                            var _itopc = 0;
                            var _ileftc = (cloneWidth * i);
                            var _ftopc = cloneHeight;
                            var _fleftc = _ileftc;

                            var _itopn = -cloneHeight;
                            var _ileftn = _ileftc;
                            var _ftopn = 0;
                            var _fleftn = _ileftc;

                            var _vtop_image = 0;
                            var _vleft_image = -_ileftc;
                            break;
                    }

                    switch (options.delayType) {
                        case 'zebra': default: var delay_time = (i % 2 == 0) ? 0 : 150; break;
                        case 'random': var delay_time = 30 * (Math.random() * 30); break;
                        case 'quence': var delay_time = i * 100; break;
                    }

                    var boxClone = me.getBoxClone(oldIndex);
                    boxClone.find('img').css({ left: _vleft_image, top: _vtop_image });
                    boxClone.css({ top: _itopc, left: _ileftc, width: cloneWidth, height: cloneHeight });
                    me.appendBoxClone(boxClone);
                    boxClone.show();
                    boxClone.delay(delay_time).animate({ top: _ftopc, left: _fleftc }, time, easing);

                    var boxNextClone = me.getBoxClone(nextIndex);
                    boxNextClone.find('img').css({ left: _vleft_image, top: _vtop_image });
                    boxNextClone.css({ top: _itopn, left: _ileftn, width: cloneWidth, height: cloneHeight });
                    me.appendBoxClone(boxNextClone);
                    boxNextClone.show();
                    var callback = (i == (total - 1)) ? function () {
                        me.onAnimateFinish(oldIndex, nextIndex);
                    } : '';
                    boxNextClone.delay(delay_time).animate({ top: _ftopn, left: _fleftn }, time, easing, callback);
                }
            },
            fadeIn: function (oldIndex, nextIndex) {
                var me = this, width = me.opt.boxWidth, height = me.opt.boxHeight,
                  currentImg = me.data[oldIndex].img,
                  nextImg = me.data[nextIndex].img;
                me.onAnimateBegin(oldIndex, nextIndex);
                var boxClone = me.getBoxClone(oldIndex);
                boxClone.css({ top: 0, left: 0, width: width, height: height });
                me.appendBoxClone(boxClone);
                boxClone.show();
                boxClone.fadeOut(1000, function () {
                    me.onAnimateFinish(oldIndex, nextIndex);
                });
            }
        }
    });

    //Ĭ������
    _ben.Slide.defaultOptions = {
        //����
        data: null,
        //Ϊtrueʱ����ie6�½��ö���Ч��
        fuckIe6: false,
        //�����ݽ����������
        randomShow: false,
        //�Ƿ��Զ�����
        autoPlay: false,
        //��ͼ�л������ٶȣ�Խ���ٶ�Խ��
        animateSpeed: 1.5,
        //Ĭ�϶�����ʽ�����������б�fadeIn��slideRight��lineRight��lineTop��lineLeft��lineBottom��random)
        defaultAni: 'fadeIn',
        //����ͼ����ʱ�䣨���룩
        thumbAniInterval: 200,
        //�Զ����ż�������룩
        interval: 2500
    };
})(jQuery, ue);

