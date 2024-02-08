var getUrlForMe = window.myApp.getUrlForMe;
var getImageUrls = window.myApp.getImageUrls;
window.onload = async function() {
    var images = document.querySelectorAll(".carousel-item img.loaded");
    images.forEach(function(img) {
        img.previousElementSibling.style.opacity = 0; // Hide the placeholder
        img.style.opacity = 1; // Show the main image
    });

    var placeholders = document.querySelectorAll('.placeholder');
    placeholders.forEach(function(placeholder) {
        placeholder.style.display = 'none'; // Hide the placeholder
    });
    await $.ajax({
        type:'GET',
        url:getUrlForMe,
        success:function (data){
            // ----------------------- here goes adding images and columns ----------------------------
            let row = document.querySelector('.row.arash');

            let id = data.dataArray[0];
            let title = data.dataArray[1];
            let brief = data.dataArray[2]
            let images = data.dataArray[3];
            let addresses = data.dataArray[4];
            // images = images.concat(data.dataArray[3]);
            // console.log(images.length);

            for(let i=0; i < images.length ; i++){
                let divElement = document.createElement('div');
                divElement.className = 'col-md-4';

                let innnerDiv = document.createElement('div');
                innnerDiv.className = 'image-container';
                let aTag = document.createElement('a');
                aTag.setAttribute('href', getImageUrls + '/' + title[i]);

                let img = new Image();
                img.src = images[i];
                img.alt = title[i];
                aTag.appendChild(img);

                let captionDiv = document.createElement('div');
                captionDiv.innerText = brief[i];
                captionDiv.className = 'caption';
                aTag.appendChild(captionDiv);

                innnerDiv.appendChild(aTag);

                divElement.appendChild(innnerDiv);

                row.appendChild(divElement);

                if((i + 1) % 3 === 0 && i !== images.length - 1) {
                    let newRow = document.createElement('div');
                    newRow.className = 'row arash';
                    newRow.style.marginTop = '20px';
                    row.parentNode.insertBefore(newRow, row.nextSibling);
                    row = newRow;
                }

                // row.appendChild(divElement);

            }
        }
    });
};