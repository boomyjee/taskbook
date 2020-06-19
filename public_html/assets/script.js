$(function(){
    $('body').on("click",'button[name=preview]',function(e){
        e.preventDefault();
        $.post('',$("form").serialize()+"&preview=preview",function(html){
            $image_input = $("input[name=image]").detach();
            $(".content").replaceWith($(html).find(".content"));
            $("input[name=image]").replaceWith($image_input);

            if ($(".preview-table").length) {
                image_input = $image_input[0];
                if (image_input.files && image_input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function (e) {
                        $(".preview-table .task-image-cell").empty().append($("<img>",{src:e.target.result}));
                    }
                    reader.readAsDataURL(image_input.files[0]);
                }
            }
        });
    })
});