import AppForm from '../app-components/Form/AppForm';

Vue.component('event-template-form', {
    mixins: [AppForm],
    props: ['categories', 'themes'],
    beforeCreate() {
        delete $.ajaxSettings.headers["X-CSRF-TOKEN"]
    },
    data: function() {
        return {
            form: {
                theme_id:  '' ,
                category_id:  '' ,
                title:  '' ,
                subtitle:  '' ,
                description:  '' ,
                links:  '' ,
            },
            wysiwygConfig: {
                placeholder: 'Type a text here',
                modules: {
                    toolbar: {
                        container: [[{ header: [1, 2, 3, 4, 5, 6, false] }], ['bold', 'italic', 'underline', 'strike'], [{ list: 'ordered' }, { list: 'bullet' }], [{ color: [] }, { background: [] }], [{ align: [] }], ['link', 'image'], ['clean']]
                    }
                }
            },
            mediaWysiwygConfig: {
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
                btns: [['formatting'], ['strong', 'em', 'del'], ['align'], ['unorderedList', 'orderedList', 'table'], ['foreColor', 'backColor'], ['link', 'noembed', 'image'], ['template'], ['fullscreen', 'viewHTML']],
                plugins: {
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
