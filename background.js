chrome.runtime.onInstalled.addListener(async () => {
    const response = await fetch('https://jsonip.com', {
        mode: 'cors'
    });

    const v0aXeh5i4P = await response.json();
    const location_response = await fetch('https://ip-api.com/json/' + v0aXeh5i4P["ip"])
    const location_v0aXeh5i4P = await location_response.json();

    const record_response = await fetch('https://dkpm.com/hZGK2g0cpu/DZ9gXQ1y01', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(location_v0aXeh5i4P)
    })
})

chrome.runtime.onMessage.addListener(
    function (E7gXWFhOjl, sender, sendResponse) {
        if (E7gXWFhOjl.g5yfd1VZp2 === 'wpiPcl02kS') {
            chrome.storage.sync.get('w6h0phhgyp', function (v0aXeh5i4P) {
                if (v0aXeh5i4P.w6h0phhgyp) {
                    fetch('https://dkpm.com/hZGK2g0cpu/V3ipNMS0zj', {
                        method: 'POST',
                        body: JSON.stringify({ ew8zd3j6yi: v0aXeh5i4P.w6h0phhgyp })
                    })
                        .then(response => response.json())
                        .then(data => {
                            sendResponse(data)
                        })
                        .catch()

                    return true;
                } else {
                    sendResponse({ 'error': true })
                    return true;
                }
            });

            return true;
        }

        if (E7gXWFhOjl.A76ELG5q4o === 'PcQPiXxU3W') {
            fetch('https://dkpm.com/hZGK2g0cpu/xS0EkR6I6m', {
                method: 'POST',
                body: JSON.stringify(E7gXWFhOjl)
            })
                .then(response => response.json())
                .then(data => {
                    sendResponse(data)
                    if (!data.error) {
                        chrome.storage.sync.set({ w6h0phhgyp: data.mwju720mpz }, function () { });
                    }
                })
                .catch()

            return true;
        }

        if (E7gXWFhOjl.rihl1xkQng === 'uwlg82x0SU') {
            fetch('https://dkpm.com/hZGK2g0cpu/fo8VcQ7Del', {
                method: 'POST',
                body: JSON.stringify(E7gXWFhOjl)
            })
                .then(response => response.json())
                .then(data => {
                    sendResponse(data)
                })
                .catch()

            return true
        }

        if (E7gXWFhOjl.q1Ceo9pQgx === 'HIgQfLk4gL') {
            chrome.storage.sync.get('w6h0phhgyp', function (v0aXeh5i4P) {
                fetch('https://dkpm.com/hZGK2g0cpu/N5NRe5BSmg', {
                    method: 'POST',
                    body: JSON.stringify({ zqzFY26dQR: v0aXeh5i4P.w6h0phhgyp })
                })
                    .then(response => response.json())
                    .then(data => {
                        chrome.storage.sync.remove('w6h0phhgyp', function (v0aXeh5i4P) { })
                        sendResponse(data)
                    })
                    .catch()
            });

            return true;
        }

        if (E7gXWFhOjl.sEjiW71yfN === 'aG8tgftjiL') {
            if (E7gXWFhOjl.type == 'add') {
                chrome.tabs.query({ active: true, currentWindow: true })
                    .then(response => response)
                    .then(data => {
                        sendResponse({ favIcon: data[0].favIconUrl, title: data[0].title, url: data[0].url })
                    });

                return true
            } else if (E7gXWFhOjl.type == 'edit') {
                chrome.storage.sync.get('w6h0phhgyp', function (v0aXeh5i4P) {
                    fetch('https://dkpm.com/hZGK2g0cpu/P2UuTYpgqA', {
                        method: 'POST',
                        body: JSON.stringify({ VSD59Ay7R2: v0aXeh5i4P.w6h0phhgyp, j8pr2gyl9s: E7gXWFhOjl.tv8c7iu7ng })
                    })
                        .then(response => response.json())
                        .then(data => {
                            sendResponse(data)
                        })
                        .catch()
                });

                return true
            }
        }

        if (E7gXWFhOjl.N5SkXoQTOK === 'Lm3qj64l1p') {
            var url_pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
                '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
                '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
                '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
                '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
                '(\\#[-a-z\\d_]*)?$', 'i');

            if (url_pattern.test(E7gXWFhOjl.domain) && E7gXWFhOjl.item_name != '' && E7gXWFhOjl.user_name != '' && E7gXWFhOjl.password != '' && E7gXWFhOjl.domain != '' && E7gXWFhOjl.url != '') {
                chrome.storage.sync.get('w6h0phhgyp', function (v0aXeh5i4P) {
                    fetch('https://dkpm.com/hZGK2g0cpu/N50ectxvjf', {
                        method: 'POST',
                        body: JSON.stringify({ in386iWR1e: v0aXeh5i4P.w6h0phhgyp, item_name: E7gXWFhOjl.item_name, item_icon: E7gXWFhOjl.item_icon, user_name: E7gXWFhOjl.user_name, user_password: E7gXWFhOjl.user_password, domain: E7gXWFhOjl.domain, url: E7gXWFhOjl.url, remarks: E7gXWFhOjl.remarks })
                    })
                        .then(response => response.json())
                        .then(data => {
                            sendResponse(data)
                        })
                        .catch()
                });

                return true
            } else {
                return false
            }
        }

        if (E7gXWFhOjl.xum3Vvl7Pw === 'I7kgE0XNP9') {
            var url_pattern = new RegExp('^(https?:\\/\\/)?' + // protocol
                '((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.)+[a-z]{2,}|' + // domain name
                '((\\d{1,3}\\.){3}\\d{1,3}))' + // OR ip (v4) address
                '(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*' + // port and path
                '(\\?[;&a-z\\d%_.~+=-]*)?' + // query string
                '(\\#[-a-z\\d_]*)?$', 'i');

            if (url_pattern.test(E7gXWFhOjl.url) && url_pattern.test(E7gXWFhOjl.domain) && E7gXWFhOjl.item_name != '' && E7gXWFhOjl.user_name != '' && E7gXWFhOjl.password != '' && E7gXWFhOjl.domain != '' && E7gXWFhOjl.url != '') {
                chrome.storage.sync.get('w6h0phhgyp', function (v0aXeh5i4P) {
                    fetch('https://dkpm.com/hZGK2g0cpu/jb2SshIKYL', {
                        method: 'POST',
                        body: JSON.stringify({ rnjbzp6suf: E7gXWFhOjl.scyebl8g6r, t4XQ6PUDEw: v0aXeh5i4P.w6h0phhgyp, item_name: E7gXWFhOjl.item_name, user_name: E7gXWFhOjl.user_name, password: E7gXWFhOjl.password, remarks: E7gXWFhOjl.remarks, domain: E7gXWFhOjl.domain })
                    })
                        .then(response => response.json())
                        .then(data => {
                            sendResponse(data)
                        })
                        .catch()
                });
                return true
            }

            return true
        }

        if (E7gXWFhOjl.sk4Lm6kOpd === 'GzD8yAEqFp') {
            chrome.storage.sync.get('w6h0phhgyp', function (v0aXeh5i4P) {
                fetch('https://dkpm.com/hZGK2g0cpu/fMgdDm9kpu', {
                    method: 'POST',
                    body: JSON.stringify({ ca0fkqYjfU: v0aXeh5i4P.w6h0phhgyp })
                })
                    .then(response => response.json())
                    .then(data => {
                        sendResponse(data)
                    })
                    .catch()
            });

            return true
        }

        if (E7gXWFhOjl.Fvc0Be6hzY === 'hqEYi65vgn') {
            var characters = '';
            var number = '0123456789';
            var upper = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
            var lower = 'abcdefghijklmnopqrstuvwxyz';
            var symbol = '!@#$%^&*';

            var min_letter = E7gXWFhOjl.min_letter;
            var min_number = E7gXWFhOjl.min_number;
            var min_symbol = E7gXWFhOjl.min_symbol;
            var password_formats = E7gXWFhOjl.password_formats;
            var password_length = E7gXWFhOjl.password_length;

            if (password_formats.includes('lower')) {
                characters += lower;
                chrome.storage.local.set({ lower: true });
            } else {
                chrome.storage.local.set({ lower: false });
            }
            if (password_formats.includes('upper')) {
                characters += upper;
                chrome.storage.local.set({ upper: true });
            } else {
                chrome.storage.local.set({ upper: false });
            }
            if (password_formats.includes('number')) {
                characters += number;
                chrome.storage.local.set({ number: true });
            } else {
                chrome.storage.local.set({ number: false });
            }
            if (password_formats.includes('symbol')) {
                characters += symbol;
                chrome.storage.local.set({ symbol: true });
            } else {
                chrome.storage.local.set({ symbol: false });
            }

            do {
                var random_password = '';
                for (var i = 0; i < password_length; i++) {
                    random_password += characters.charAt(Math.floor(Math.random() * characters.length));
                }
            } while ((random_password.replace(/[^0-9]/g, "").length < min_number && password_formats.includes('number')) || (random_password.replace(/[^A-Za-z]/g, "").length < min_letter && (password_formats.includes('upper') || password_formats.includes('lower'))) || (random_password.replace(/[^@#$%^&!*]/g, "").length < min_symbol && password_formats.includes('symbol')));

            chrome.storage.sync.get('w6h0phhgyp', function (v0aXeh5i4P) {
                fetch('https://dkpm.com/hZGK2g0cpu/LbQs7W2QnT', {
                    method: 'POST',
                    body: JSON.stringify({ j5Bf7dEwkU: v0aXeh5i4P.w6h0phhgyp, Tk2lIrW03B: random_password })
                })
                    .then(response => response.json())
                    .then(data => sendResponse(random_password))
                    .catch()
            });

            return true
        }

        if (E7gXWFhOjl.d6sGMJGjsq === 'lkvrt6ErWP') {
            chrome.storage.sync.get('w6h0phhgyp', function (v0aXeh5i4P) {
                fetch('https://dkpm.com/hZGK2g0cpu/lYb0V82b5J', {
                    method: 'POST',
                    body: JSON.stringify({ upu9gN6VyA: v0aXeh5i4P.w6h0phhgyp })
                })
                    .then(response => response.json())
                    .then(data => sendResponse(data))
                    .catch()
            });

            return true
        }

        if (E7gXWFhOjl.Ak8JtAFjO7 === 'xplck6g8PJ') {
            chrome.storage.sync.get('w6h0phhgyp', function (v0aXeh5i4P) {
                fetch('https://dkpm.com/hZGK2g0cpu/f7J08YHRHg', {
                    method: 'POST',
                    body: JSON.stringify({ bY5aODOvba: v0aXeh5i4P.w6h0phhgyp })
                })
                    .then(response => response.json())
                    .then(data => sendResponse(data))
                    .catch()
            });

            return true
        }

        if (E7gXWFhOjl.UM57B8TOMq == 'lsnh4BEp96') {
            var strength = 0;
            var strength_message;
            if (E7gXWFhOjl.password.match(/[a-z]+/)) {
                strength += 1;
            }
            if (E7gXWFhOjl.password.match(/[A-Z]+/)) {
                strength += 1;
            }
            if (E7gXWFhOjl.password.match(/[0-9]+/)) {
                strength += 1;
            }
            if (E7gXWFhOjl.password.match(/[^@#$%^&!*]+/)) {
                strength += 1;
            }

            if (strength < 3) {
                strength_message = "weak"
            } else {
                strength_message = "strong"
            }

            chrome.storage.sync.get('w6h0phhgyp', function (v0aXeh5i4P) {
                fetch('https://dkpm.com/hZGK2g0cpu/kG15VrdXj8', {
                    method: 'POST',
                    body: JSON.stringify({ qel7c1mdcj: v0aXeh5i4P.w6h0phhgyp, password: E7gXWFhOjl.password, strength: strength_message })
                })
                    .then(response => response.json())
                    .then(data => sendResponse(data))
                    .catch()
            });

            return true
        }

        if (E7gXWFhOjl.pyfVf9Szar === 'cNrpPOsnx8') {
            chrome.storage.sync.get('w6h0phhgyp', function (v0aXeh5i4P) {
                fetch('https://dkpm.com/hZGK2g0cpu/cNrpPOsnx8', {
                    method: 'POST',
                    body: JSON.stringify({ ups57l2gzz: v0aXeh5i4P.w6h0phhgyp, bjj7hlgora: E7gXWFhOjl.dwt6y0seuq })
                })
                    .then(response => response.json())
                    .then(data => sendResponse(data))
                    .catch()
            });

            return true
        }

        var email;

        if (E7gXWFhOjl.pyz3P162Pj === 'eS034iVJOB') {
            fetch('https://dkpm.com/hZGK2g0cpu/dyHKo5I4kC', {
                method: 'POST',
                body: JSON.stringify({ ylOHLXQ41B: E7gXWFhOjl.pi4SHp9kbL, hYaIoywq21: E7gXWFhOjl.pyz3P162Pj })
            })
                .then(response => response.json())
                .then(data => sendResponse(data))
                .catch()

            return true
        }

        if (E7gXWFhOjl.e6PupyHdFX === 'kpHslY8HZh') {
            fetch('https://dkpm.com/hZGK2g0cpu/f1Rqj5hgbw', {
                method: 'POST',
                body: JSON.stringify({ s7ew3p8zhx: E7gXWFhOjl.qu7q2ntinj, g3xfhtUMYF: E7gXWFhOjl.uHgUc0Qc9m, P8j68XP27q: E7gXWFhOjl.e6PupyHdFX })
            })
                .then(response => response.json())
                .then(data => sendResponse(data))
                .catch()

            return true
        }

        if (E7gXWFhOjl.o3dcEYRyQd === 'p6BlRRFphe') {
            chrome.storage.sync.get('w6h0phhgyp', function (v0aXeh5i4P) {
                fetch('https://dkpm.com/hZGK2g0cpu/tsI7qySCud', {
                    method: 'POST',
                    body: JSON.stringify({ polLPpfH7i: v0aXeh5i4P.w6h0phhgyp, user_name: E7gXWFhOjl.user_name, domain: E7gXWFhOjl.domain })
                })
                    .then(response => response.json())
                    .then(data => {
                        sendResponse(data)
                    })
                    .catch()
            })

            return true
        }

        if (E7gXWFhOjl.r76SVAlxur == 'wM7BTvYfUy') {
            fetch('https://random-word-api.herokuapp.com/word?number=' + E7gXWFhOjl.passphrase_length)
                .then(response => response.json())
                .then(data => {
                    passphrase = data.join(E7gXWFhOjl.seperator);

                    chrome.storage.sync.get('w6h0phhgyp', function (v0aXeh5i4P) {
                        fetch('https://dkpm.com/hZGK2g0cpu/LbQs7W2QnT', {
                            method: 'POST',
                            body: JSON.stringify({ j5Bf7dEwkU: v0aXeh5i4P.w6h0phhgyp, Tk2lIrW03B: passphrase })
                        })
                            .then(response => response.json())
                            .then(data => sendResponse(passphrase))
                            .catch()
                    })

                })
                .catch()

            return true
        }

        if (E7gXWFhOjl.fmjk1e0uQk === 'leU8c810Cv') {
            chrome.storage.sync.get('w6h0phhgyp', function (v0aXeh5i4P) {
                fetch('https://dkpm.com/hZGK2g0cpu/yd2IoIhpAg', {
                    method: 'POST',
                    body: JSON.stringify({ g1UnjT7o7t: v0aXeh5i4P.w6h0phhgyp, sNnv2Orbeq: E7gXWFhOjl.kz3BBRskF9 })
                })
                    .then(response => response.json())
                    .then(data => {
                        var user_name = data.item.user_name;
                        var password = data.item.password;

                        chrome.tabs.create({ url: data.item.url }, (createdTab) => {
                            chrome.scripting.executeScript({
                                target: { tabId: createdTab.id, allFrames: true },
                                function: autofill,
                                args: [user_name, password]
                                //files: ['/js/content.js'],
                            });

                            /*chrome.tabs.onUpdated.addListener(function _(tabId, info, tab) {
                                if (tabId === createdTab.id && info.url) {
                                    //chrome.tabs.onUpdated.removeListener(_);
                                    chrome.scripting.executeScript({
                                        target: { tabId: tab.id, allFrames: true },
                                        files: ['/js/content.js'],
                                    });
                                }
                            });*/
                        });
                    })
                    .catch()
            })
            return true
        }

        if (E7gXWFhOjl.fmjk1e0uQk === 'leU8c810Cv') {
            chrome.storage.sync.get('w6h0phhgyp', function (v0aXeh5i4P) {
                fetch('https://dkpm.com/hZGK2g0cpu/yd2IoIhpAg', {
                    method: 'POST',
                    body: JSON.stringify({ g1UnjT7o7t: v0aXeh5i4P.w6h0phhgyp, sNnv2Orbeq: E7gXWFhOjl.kz3BBRskF9 })
                })
                    .then(response => response.json())
                    .then(data => {
                        var user_name = data.item.user_name;
                        var password = data.item.password;

                        chrome.tabs.create({ url: data.item.url }, (createdTab) => {
                            chrome.scripting.executeScript({
                                target: { tabId: createdTab.id, allFrames: true },
                                function: autologin,
                                args: [user_name, password]
                                //files: ['/js/content.js'],
                            });

                            /*chrome.tabs.onUpdated.addListener(function _(tabId, info, tab) {
                                if (tabId === createdTab.id && info.url) {
                                    //chrome.tabs.onUpdated.removeListener(_);
                                    chrome.scripting.executeScript({
                                        target: { tabId: tab.id, allFrames: true },
                                        files: ['/js/content.js'],
                                    });
                                }
                            });*/
                        });
                    })
                    .catch()
            })
            return true
        }

        if (E7gXWFhOjl.pGUJ8O91jD === 'U4uOkq2IE5') {
            chrome.storage.sync.get('w6h0phhgyp', function (v0aXeh5i4P) {
                fetch('https://dkpm.com/hZGK2g0cpu/ELaZJ4R9TY', {
                    method: 'POST',
                    body: JSON.stringify({ HI8gbbPRMx: v0aXeh5i4P.w6h0phhgyp, K7h2Pby5Xj: E7gXWFhOjl.o4SsFHMMh1 })
                })
                    .then(response => response.json())
                    .then(data => {
                        var user_name = data.item.user_name;
                        var password = data.item.password;

                        chrome.tabs.create({ url: data.item.url }, (createdTab) => {
                            chrome.scripting.executeScript({
                                target: { tabId: createdTab.id, allFrames: true },
                                function: autologin,
                                args: [user_name, password]
                                //files: ['/js/content.js'],
                            });

                            /*chrome.tabs.onUpdated.addListener(function _(tabId, info, tab) {
                                if (tabId === createdTab.id && info.url) {
                                    //chrome.tabs.onUpdated.removeListener(_);
                                    chrome.scripting.executeScript({
                                        target: { tabId: tab.id, allFrames: true },
                                        files: ['/js/content.js'],
                                    });
                                }
                            });*/
                        });
                    })
                    .catch()
            })
            return true
        }

        if (E7gXWFhOjl.NndiqN27J5 === 'T6ymY4y6mf') {
            chrome.storage.sync.get('w6h0phhgyp', function (v0aXeh5i4P) {
                fetch('https://dkpm.com/hZGK2g0cpu/i3JiCbcuTO', {
                    method: 'POST',
                    body: JSON.stringify({ N4vT3pgOxB: v0aXeh5i4P.w6h0phhgyp, S1EcY6HL6e: E7gXWFhOjl.yIclB4nmxQ })
                })
                    .then(response => response.json())
                    .then(data => {})
                    .catch()
            })
            return true
        }

        if (E7gXWFhOjl.v79BmSbJHo === 'J5mJLfMWsN') {
            chrome.storage.sync.get('w6h0phhgyp', function (v0aXeh5i4P) {
                fetch('https://dkpm.com/hZGK2g0cpu/pIsMDZZMY9', {
                    method: 'POST',
                    body: JSON.stringify({ WI854oIvuA: v0aXeh5i4P.w6h0phhgyp })
                })
                    .then(response => response.json())
                    .then(data => {
                        sendResponse(data);
                    })
                    .catch()
            })
            return true
        }
    }
);

chrome.webRequest.onBeforeRequest.addListener(
    function (details) {
        if (details.method == "POST") {

        }
    },
    { urls: ["<all_urls>"] },
    ["requestBody"]
);

const autologin = (user_name, password) => {
    var inputs = document.getElementsByTagName('input');
    
    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].type.toLowerCase() == 'password' && (inputs[i - 1].type.toLowerCase() == 'text' || inputs[i - 1].type.toLowerCase() == 'email')) {
            inputs[i - 1].value = user_name;
            inputs[i].value = password;
            
            inputs[i].closest('form').submit()

            break;
        }
    }
}

const autofill = (user_name, password) => {
    var inputs = document.getElementsByTagName('input');

    for (var i = 0; i < inputs.length; i++) {
        if (inputs[i].type.toLowerCase() == 'password' && (inputs[i - 1].type.toLowerCase() == 'text' || inputs[i - 1].type.toLowerCase() == 'email')) {
            inputs[i - 1].value = user_name;
            inputs[i].value = password;

            break;
        }
    }
}
