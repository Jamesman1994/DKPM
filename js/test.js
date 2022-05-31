"use strict";

var inputs = document.getElementsByTagName('input');

/*document.addEventListener('submit', function (e) {
    e.preventDefault();

    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].type.toLowerCase() == 'password' && (inputs[i - 1].type.toLowerCase() == 'text' || inputs[i - 1].type.toLowerCase() == 'email')) {
            chrome.runtime.sendMessage({ o3dcEYRyQd: 'p6BlRRFphe', user_name: inputs[i-1].value, domain: window.location.hostname}, function (result) {
                if (result.error == false) {
                    $('body').prepend(
                        '<iframe id="dkpm_iframe" src="chrome-extension://dffmidapddmfgieddfejokcpjeiooebb/x8CWjWnDci.html" style="width:100%;max-height:53px;border:0px;box-shadow:0px 3px 10px -2px rgb(0 0 0 / 20%)"></iframe> '
                    );                
                }
            });

            //break;
        }
    }

    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].type.toLowerCase() == 'password' && (inputs[i - 1].type.toLowerCase() == 'text' || inputs[i - 1].type.toLowerCase() == 'email')) {
            chrome.runtime.sendMessage({ o3dcEYRyQd: 'p6BlRRFphe', item_name: document.title, item_icon: $('link[rel~="icon"]').prop('href'), user_name: inputs[i-1].value, user_password: inputs[i].value }, function (result) {
                
            });

            break;
        }
    }
});*/


/*'<div id="dkpm_bar_container" style="background-color: #fff;padding: 0 10px;display: grid;grid-template-columns: 55px auto 55px;grid-column-gap: 10px;box-sizing: border-box;min-height: 45px; width: 100%;box-shadow:0px 3px 10px -2px rgb(0 0 0 / 20%)">' +
'<div id="logo">' +
    '<a href="http://dkpm.com" target="_blank" id="logo-link" title="Bitwarden">' +
        '<img id="dkpm_logo" src="images/doorknock_48.png">' +
    '</a>' +
'</div>' +
'<div id="content" style="display: grid;grid-template-columns: 90% 10%;margin-top:10px">' +
    '<div class="text" style="width:fit-content; font-size: 20px">希望 DOORKNOCK 幫您儲存這個密碼嗎？</div>' +
    '<div class="buttons" style="float:right;width:fit-content">' +
        '<button type="button" id="dkpm_never" style="font-size:22px;font-weight:bold;color:#fff;background-color:#973c35;border-radius:3px; margin-left:5px">永不</button>' +
        '<button type="button" id="dkpm_save" style="font-size:22px;font-weight:bold;color:#fff;background-color:#973c35;border-radius:3px; margin-left:5px">儲存</button>' +
    '</div>' +
'</div>' +
'<div id="close" style="margin-top:10px">' +
    '<button class="fas fa-times" id="dkpm_close_bar" style="color: #973c35; background-color: transparent;font-size: 30px" onclick="document.getElementById("dkpm_bar_container").style.display = none;"></button>' +
'</div>'  +
'</div>'*/

