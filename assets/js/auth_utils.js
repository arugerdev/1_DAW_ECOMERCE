
function login(email, password, callback = () => { }) {
    $.ajax({
        url: '/utils/auth_utils.php',
        type: 'POST',
        data: {
            action: 'login',
            email: email,
            password: password
        },
        success: (data) => callback(JSON.parse(data))


    });
}

function register(customer, callback = () => { }) {
    $.ajax({
        url: "/utils/auth_utils.php",
        type: 'POST',
        data: {

            action: "register",
            customer: JSON.stringify(customer),
        },
        success: (data) => {
            callback(JSON.parse(data))
        }
    });
}

function loadCustomerInfo(callback = () => { }) {
    $.ajax({
        url: "/utils/checkout_utils.php",
        type: "POST",
        data: {
            "action": "get_customer_info"
        },
        success: (data) => callback(JSON.parse(data))
    });
}