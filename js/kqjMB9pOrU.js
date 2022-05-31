async function SszN5GYgwh() {
    const urlParams = new URLSearchParams(window.location.search);
    const NiPII1CP98 = urlParams.get('tGjsGRc7ge');

    const response = await fetch('http://dkpm.com/hZGK2g0cpu/b4MnMsaMWO', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify({Lpv7lD0BKP: NiPII1CP98})
    })

    const result = await response.json();
    
    if (result.error == true) {
        window.open('','_parent','');
        window.close();
    }
}

SszN5GYgwh();

async function TD9lVl4r0T() {
    const urlParams = new URLSearchParams(window.location.search);
    const pM2wEl11nn = urlParams.get('tGjsGRc7ge');

    const response = await fetch('http://dkpm.com/hZGK2g0cpu/CZNqNP2dxb', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json;charset=utf-8'
        },
        body: JSON.stringify({ BQQL4Emv2j: pM2wEl11nn, oAA8vc5r7G: document.getElementById('Z3P7XEHmKl').value, pQVeZ6INYC: document.getElementById('wAJgn86T6E').value })
    })

    const result = await response.json();

    if (navigator.language || navigator.userLanguage == "zh-TW") {
        different_error = "兩次輸入並不相同"
        format_error = "密碼格式錯誤"
        fail = "連接逾期,請重新申請更改"
        success = "已成功更改密碼,請使用新密碼登入系統"
    } else if (navigator.language || navigator.userLanguage == "en") {
        different_error = "The two passwords are not the same"
        format_error = "Wrong password format"
        fail = "The connection is overdue, please re-apply to change"
        success = "Password changed successfully"
    } else if (navigator.language || navigator.userLanguage == "zh-CN") {
        different_error = "两次输入并不相同"
        format_error = "密码格式错误"
        fail = "连接逾期,请重新申请更改"
        success = "已成功更改密码,请使用新密码登入系统"
    } else if (navigator.language || navigator.userLanguage == "ko") {
        different_error = "두 비밀번호가 같지 않습니다"
        format_error = "잘못된 비밀번호 형식"
        fail = "연결 기한이 지났습니다. 변경하려면 다시 신청하세요."
        success = "비밀번호가 성공적으로 변경되었습니다"
    } else if (navigator.language || navigator.userLanguage == "th") {
        different_error = "รหัสผ่านทั้งสองไม่เหมือนกัน"
        format_error = "รูปแบบรหัสผ่านไม่ถูกต้อง"
        fail = "การเชื่อมต่อเกินกำหนด โปรดสมัครใหม่เพื่อเปลี่ยน"
        success = "เปลี่ยนรหัสผ่านสำเร็จ"
    } else if (navigator.language || navigator.userLanguage == "ja") {
        different_error = "2つのパスワードは同じではありません"
        format_error = "間違ったパスワード形式"
        fail = "接続が遅れています。変更するには再申請してください"
        success = "パスワードは正常に変更されました"
    } else if (navigator.language || navigator.userLanguage == "es") {
        different_error = "Las dos contraseñas no son iguales."
        format_error = "Formato de contraseña incorrecto"
        fail = "La conexión está vencida, vuelva a aplicar para cambiar"
        success = "Contraseña cambiada con éxito"
    } else if (navigator.language || navigator.userLanguage == "fr") {
        different_error = "Les deux mots de passe ne sont pas identiques"
        format_error = "Format de mot de passe erroné"
        fail = "La connexion est en retard, veuillez réappliquer pour changer"
        success = "Le mot de passe a été changé avec succès"
    } else if (navigator.language || navigator.userLanguage == "de") {
        different_error = "Die beiden Passwörter sind nicht identisch"
        format_error = "Falsches Passwortformat"
        fail = "Die Verbindung ist überfällig, bitte beantragen Sie die Änderung erneut"
        success = "das Passwort wurde erfolgreich geändert"
    } else if (navigator.language || navigator.userLanguage == "ru") {
        different_error = "Два пароля не совпадают"
        format_error = "Неверный формат пароля"
        fail = "Подключение просрочено, пожалуйста, повторно подайте заявку на изменение"
        success = "Пароль успешно изменен"
    }

    if (result.error && result.message == "different") {
        Swal.fire({
            position: 'center',
            icon: 'error',
            text: different_error,
            showConfirmButton: false,
            timer: 2000
        })
    } else if (result.error && result.message == "format") {
        Swal.fire({
            position: 'center',
            icon: 'error',
            text: format_error,
            showConfirmButton: false,
            timer: 2000
        })
    } else if (result.error && result.message == "fail") {
        Swal.fire({
            position: 'center',
            icon: 'error',
            text: fail,
            showConfirmButton: false,
            timer: 5000
        }).then(() => {
            window.close();
        })
    } else {
        Swal.fire({
            position: 'center',
            icon: 'success',
            text: success,
            showConfirmButton: false,
            timer: 2000
        }).then(() => {
            window.close();
        })
    }
}

