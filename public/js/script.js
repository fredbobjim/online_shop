$('input#image').change(function () {
    let fileName = $(this).val().split('\\').pop()
    $('#file-name').text(fileName)
})
