/* globals Chart:false, feather:false */

(function () {
  'use strict'

  feather.replace({ 'aria-hidden': 'true' })

})()

function previewImage() {
  const img = document.querySelector('#img');
  const imgPreview = document.querySelector('.img-preview');

  imgPreview.style.display = block

  const oFReader = new FileReader();
  oFReader.readAsDataURL(img.files[0]);
  oFReader.onload = (oFRevent) => {
      imgPreview.src = oFRevent.target.result;
  }
}
