<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{asset('css/englishStyle.css')}}">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <title>JS Ajax Blade Engin</title>
</head>
<body>
<div id="myDiv">
    <div id="firstDiv" class="row" style="margin-top: 10px">
        <div class="col-md-4" >
            <div class="image-container">
                <img src="{{asset('images/none.jpg')}}" alt="arashTalentOne" />
                <div class="caption">Caption 1</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="image-container">
                <img src="{{asset('images/ntwo.jpg')}}" alt="arashTalentOne" />
                <div class="caption">Caption 2</div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="image-container">
                <img src="{{asset('images/nthree.jpg')}}" alt="arashTalentOne" />
                <div class="caption">Caption 3</div>
            </div>
        </div>
    </div>
</div>

<script>
    window.onload = async function (){
          await $.ajax({
            type:'GET',
            url:"{{URL::route('GetImagesForAjax')}}",
            success:function (data){
                // ----------------------- here goes adding images and columns ----------------------------
                let row = document.querySelector('.row');

                let id = data.dataArray[0];
                let title = data.dataArray[1];
                let brief = data.dataArray[2]
                let images = data.dataArray[3];

                for(let i=0; i < images.length ; i++){
                    let divElement = document.createElement('div');
                    divElement.className = 'col-md-4';

                    let innnerDiv = document.createElement('div');
                    innnerDiv.className = 'image-container';

                    let img = new Image();
                    img.src = images[i];
                    img.alt = title[i];
                    innnerDiv.appendChild(img);

                    let captionDiv = document.createElement('div');
                    captionDiv.innerText = brief[i];
                    captionDiv.className = 'caption';
                    innnerDiv.appendChild(captionDiv);

                    divElement.appendChild(innnerDiv);

                    row.appendChild(divElement);

                    if((i + 1) % 3 === 0 && i !== images.length - 1) {
                        let newRow = document.createElement('div');
                        newRow.className = 'row';
                        row.parentNode.insertBefore(newRow, row.nextSibling);
                        row = newRow;
                    }

                    row.appendChild(divElement);

                }
            }
        });
    }
</script>
</body>
</html>