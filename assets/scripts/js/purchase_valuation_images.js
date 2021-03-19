
$(document).ready(function(){

    //get base URL *********************
    var url = $('#url').val();
    

  //Show Images Purchase Valuation ***************************
    $(document).on('click', '.show-images', function () {
        var image_id = $(this).val();
    

        $.ajax({
            headers: {'X-CSRF-TOKEN': $('input[name=_token]').val()},
            type: "POST",
            url: '/show-images',
            data: {
                id: image_id
            },
            success: function (data) {
                if (data.success == 200) {
                   
                    $.each(data.data, function (index, el) {
                        $(`<div class="carousel-item">
                            <img class="d-block w-100" src="local/public/img_app/images_purchase/${el.name}" alt="${index}" height="200">
                        </div>`).appendTo('.carousel-inner');
                        $(`<li data-target="#carousel" data-slide-to="${index}"></li>`).appendTo('.carousel-indicators');
                    });                    
                
                    $('.carousel-item').first().addClass('active');
                    $('.carousel-indicators > li').first().addClass('active');
                    $('#carouselExampleControls1').carousel();
                    $('#myModal').modal('show');
                }
                
                 
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

});