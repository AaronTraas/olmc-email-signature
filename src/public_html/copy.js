document.addEventListener('DOMContentLoaded', function(){
    var copyButtons = document.querySelectorAll('button')
    console.log(copyButtons)

    function copyButtonClick(e) {
        window.getSelection().removeAllRanges();

        var button = e.target
        var element = document.getElementById(button.dataset.target)
        console.log(element)
        range = document.createRange();
        range.selectNode(element);
        window.getSelection().addRange(range);

        try {
            var copied = document.execCommand('copy')
            if(copied) {
                console.log('copied: \n' + copied)
                for(i = 0; i<copyButtons.length; i++) {
                    copyButtons[i].innerText = 'Copy Signature'
                    copyButtons[i].className = ''
                }
                button.innerText = 'Copied to Clipboard!'
                button.className = 'copied'
            }
        } catch (ignored) {
            alert('Failed to copy element. Please use a more modern browser.')
        }
    }

    for(i = 0; i<copyButtons.length; i++) {
        copyButtons[i].addEventListener('click', copyButtonClick)
    }
});
