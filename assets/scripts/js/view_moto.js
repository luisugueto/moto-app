$(document).ready(function(){
    var quantity = 1;

    $('.quantity-right-plus').click(function(e){
        e.preventDefault();
        var quantity = parseInt($('#quantity').val());
        $('#quantity').val(quantity + 1);
    });

    $('.quantity-left-minus').click(function(e){
        e.preventDefault();
        var quantity = parseInt($('#quantity').val());
        if(quantity > 1){
            $('#quantity').val(quantity - 1);
        }
    });

    $(document).on('click', '.show-images', function () {
        var image_id = $(this).attr('id');
    console.log(image_id)

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
                            <img class="d-block w-100 h-100" src="../local/public/img_app/images_purchase/${el.name}" alt="${index}" >
                        </div>`).appendTo('.carousel-inner');
                        $(`<li data-target="#carousel" data-slide-to="${index}"></li>`).appendTo('.carousel-indicators');
                    });                    
                
                    $('.carousel-item').first().addClass('active');
                    $('.carousel-indicators > li').first().addClass('active');
                    $('#carouselExampleControls1').carousel();
                    $('#productModal').modal('show');
                }
                
                 
            },
            error: function (data) {
                console.log('Error:', data);
            }
        });
    });

});