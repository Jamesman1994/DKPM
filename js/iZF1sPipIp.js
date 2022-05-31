$('#jMlQZMEB1a').change(function () {
    chrome.runtime.sendMessage({ NndiqN27J5: 'T6ymY4y6mf', yIclB4nmxQ: $('#jMlQZMEB1a').val() }, (result) => {});
})

async function U8tXqkE8X4() {
    chrome.runtime.sendMessage({ v79BmSbJHo: 'J5mJLfMWsN' }, (result) => {
        if (!result.error) {
            $('#jMlQZMEB1a').val(result.NndiqN27J5).change();
        }
    });
}

U8tXqkE8X4();