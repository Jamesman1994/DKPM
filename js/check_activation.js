async function check_activation() {
    const urlParams = new URLSearchParams(window.location.search);
    const Jcvhz3VrFy = urlParams.get('rhdl5a2s02');
    const rgQNJDgl5r = urlParams.get('PuCFroHt8C');

    const response = await fetch('https://dkpm.com/hZGK2g0cpu/vnbQqnrIH6', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify({Y1lO0AX9p4: Jcvhz3VrFy, TmwU0hRq5G: rgQNJDgl5r})
    })

    const result = await response.json();
    
    if (result.error == true) {
        window.open('','_parent','');
        window.close();
    }
}

check_activation();

