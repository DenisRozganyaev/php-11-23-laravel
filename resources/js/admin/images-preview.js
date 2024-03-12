import '../bootstrap'

const imagesSelectors = {
    imagesWrapper: '.images-wrapper',
    imagesInput: '#images',
    thumbnailPreview: '#thumbnail-preview',
    thumbnailInput: '#thumbnail'
};

$(document).ready(() => {
    if (window.FileReader) {
        // $('#image').
        $(imagesSelectors.imagesInput).change(function () {
            let counter = 0, file;
            const template = '<div class="mb-4"><img src="__url__" style="width: 100%" /></div>';

            $(imagesSelectors.imagesWrapper).html('');

            console.log('this.files', this.files)
            while (file = this.files[counter++]) {
                const reader = new FileReader();
                reader.onloadend = (function () {
                    return function (e) {
                        console.log('e.target', e.target);
                        console.log('e.target.result', e.target.result);
                        const img = template.replace('__url__', e.target.result);
                        $(imagesSelectors.imagesWrapper).append(img);
                    }
                })(file)
                reader.readAsDataURL(file);
            }
        });

        $(imagesSelectors.thumbnailInput).change(function() {
           const reader = new FileReader();
           reader.onloadend = (e) => {
             $(imagesSelectors.thumbnailPreview).attr('src', e.target.result)
           };
            reader.readAsDataURL(this.files[0]);
        });
    }
});
