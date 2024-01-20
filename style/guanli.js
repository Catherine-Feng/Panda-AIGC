function confirmDelete() {
    return confirm('确定要删除这条记录吗？');
}




    function validateForm() {
        // 检查咒语字段
        var spell = document.getElementById("spell").value.trim();
        if (spell === "") {
            alert("请填写咒语");
            return false; // 阻止表单提交
        }

        // 检查所有图片上传字段
        var imageInputs = ["cover_image", "additional_image1", "additional_image2", "additional_image3"];
        for (var i = 0; i < imageInputs.length; i++) {
            var input = document.getElementById(imageInputs[i]);
            if (!input.files.length) {
                alert("请上传所有图片");
                return false; // 阻止表单提交
            }
        }

        // 所有验证通过，允许表单提交
        return true;
    }