window.addEventListener('DOMContentLoaded',function () {
    const antiqCaptchasElements = document.getElementsByClassName("antiq-captcha");
    for (var i = 0; i < antiqCaptchasElements.length; i++) {
        var antiqCaptchaElement = antiqCaptchasElements[i];

        const containerNode = document.createElement('div');
        containerNode.style = 'width:' + antiqCaptchaElement.clientWidth + 'px; text-align:center;';

        const captchaNode = document.createElement("img");
        captchaNode.src = antiqCaptchaElement.dataset.captcha;
        captchaNode.style = 'width:' + antiqCaptchaElement.clientWidth + 'px;';
        containerNode.append(captchaNode);

        antiqCaptchaElement.parentNode.insertBefore(containerNode, antiqCaptchaElement);
    }
}); 