import AppForm from '../app-components/Form/AppForm';

Vue.component('event-form', {
    props: ['categories', 'themes'],
    mixins: [AppForm],
    data: function() {
        return {
            category: '',
            theme: '',
            mediaCollections: ['images'],
            form: {
                theme_id:  '',
                category_id:  '',
                title:  '',
                subtitle:  '',
                description:  '',
                links:  '',
                event_date:  '',
                event_time:  '',
                price:  '',
                is_published:  false ,
            },
            datePickerConfig: {
                dateFormat: 'Y-m-d',
                altInput: true,
                altFormat: 'd.m.Y',
                locale: 'de'
            },
            timePickerConfig: {
                enableTime: true,
                noCalendar: true,
                time_24hr: true,
                enableSeconds: false,
                dateFormat: 'H:i:s',
                altInput: true,
                altFormat: 'H:i',
                locale: null
            },
            wysiwygConfig: {
                placeholder: 'Type a text here',
                modules: {
                    toolbar: {
                        container: [[{ header: [1, 2, 3, 4, 5, 6, false] }], ['bold', 'italic', 'underline', 'strike'], [{ list: 'ordered' }, { list: 'bullet' }], [{ color: [] }, { background: [] }], [{ align: [] }], ['link', 'image'], ['clean']]
                    }
                }
            },
            myMediaWysiwygConfig: {
                autogrow: true,
                imageWidthModalEdit: true,
                btnsDef: {
                    image: {
                        dropdown: ['insertImage', 'upload', 'base64'],
                        ico: 'insertImage'
                    },
                    align: {
                        dropdown: ['justifyLeft', 'justifyCenter', 'justifyRight', 'justifyFull'],
                        ico: 'justifyLeft'
                    }
                },
                btns: [['formatting'], ['strong', 'em', 'del'], ['align'], ['unorderedList', 'orderedList', 'table'], ['foreColor'], ['link', 'noembed', 'image'], ['template'], ['fullscreen', 'viewHTML']],
                plugins: {
                    noembed: {
                        init: function (trumbowyg) {
                            trumbowyg.o.plugins.noembed = $.extend(true, {}, defaultOptions, trumbowyg.o.plugins.noembed || {});

                            var btnDef = {
                                fn: function () {
                                    var $modal = trumbowyg.openModalInsert(
                                        // Title
                                        trumbowyg.lang.noembed,

                                        // Fields
                                        {
                                            url: {
                                                label: 'URL',
                                                required: true
                                            }
                                        },

                                        // Callback
                                        function (data) {
                                            $.ajax({
                                                url: trumbowyg.o.plugins.noembed.proxy,
                                                type: 'GET',
                                                data: data,
                                                cache: false,
                                                dataType: 'jsonp',

                                                success: trumbowyg.o.plugins.noembed.success || function (data) {
                                                    if (data.html) {
                                                        trumbowyg.execCmd('insertHTML', data.html);
                                                        setTimeout(function () {
                                                            trumbowyg.closeModal();
                                                        }, 250);
                                                    } else {
                                                        trumbowyg.addErrorOnModalField(
                                                            $('input[type=text]', $modal),
                                                            data.error
                                                        );
                                                    }
                                                },
                                                error: trumbowyg.o.plugins.noembed.error || function (e) {
                                                    trumbowyg.addErrorOnModalField(
                                                        $('input[type=text]', $modal),
                                                        trumbowyg.lang.noembedError
                                                    );
                                                }
                                            });
                                        }
                                    );
                                }
                            };
                            trumbowyg.addBtnDef('noembed', btnDef);
                        }
                    },
                    upload: {
                        // https://alex-d.github.io/Trumbowyg/documentation/plugins/#plugin-upload
                        serverPath: '/admin/wysiwyg-media',
                        imageWidthModalEdit: true,
                        success: function success(data, trumbowyg, $modal, values) {
                            that.wysiwygMedia.push(data.mediaId);

                            function getDeep(object, propertyParts) {
                                var mainProperty = propertyParts.shift(),
                                    otherProperties = propertyParts;

                                if (object !== null) {
                                    if (otherProperties.length === 0) {
                                        return object[mainProperty];
                                    }

                                    if ((typeof object === 'undefined' ? 'undefined' : _typeof(object)) === 'object') {
                                        return getDeep(object[mainProperty], otherProperties);
                                    }
                                }
                                return object;
                            }

                            if (!!getDeep(data, trumbowyg.o.plugins.upload.statusPropertyName.split('.'))) {
                                var url = getDeep(data, trumbowyg.o.plugins.upload.urlPropertyName.split('.'));
                                trumbowyg.execCmd('insertImage', url, false, true);
                                var $img = $('img[src="' + url + '"]:not([alt])', trumbowyg.$box);
                                $img.attr('alt', values.alt);
                                if (trumbowyg.o.imageWidthModalEdit && parseInt(values.width) > 0) {
                                    $img.attr({
                                        width: values.width
                                    });
                                }
                                setTimeout(function () {
                                    trumbowyg.closeModal();
                                }, 250);
                                trumbowyg.$c.trigger('tbwuploadsuccess', [trumbowyg, data, url]);
                            } else {
                                trumbowyg.addErrorOnModalField($('input[type=file]', $modal), trumbowyg.lang[data.message]);
                                trumbowyg.$c.trigger('tbwuploaderror', [trumbowyg, data]);
                            }
                        }
                    },
                    reupload: {
                        success: function success(data, trumbowyg, $modal, values, $img) {
                            that.wysiwygMedia.push(data.mediaId);

                            $img.attr({
                                src: data.file
                            });
                            trumbowyg.execCmd('insertHTML');
                            setTimeout(function () {
                                trumbowyg.closeModal();
                            }, 250);
                            var url = getDeep(data, trumbowyg.o.plugins.upload.urlPropertyName.split('.'));
                            trumbowyg.$c.trigger('tbwuploadsuccess', [trumbowyg, data, url]);
                        }
                    }
                }
            }
        }
    }
});
