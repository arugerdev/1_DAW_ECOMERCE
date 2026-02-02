function capitalizeFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function htmlspecialchars(str) {
    var div = document.createElement('div');
    if (str) {
        div.appendChild(document.createTextNode(str));
        return div.innerHTML;
    }
    return '';
}

function formatNumber(n) {

    return n.replace(/\D/g, "").replace(/\B(?=(\d{3})+(?!\d))/g, ",")
}

function formatCurrency(input, blur, currencyChar) {
    var input_val = input.val();
    if (input_val === "") {
        return;
    }
    var original_len = input_val.length;
    var caret_pos = input.prop("selectionStart");
    if (input_val.indexOf(".") >= 0) {
        var decimal_pos = input_val.indexOf(".");

        var left_side = input_val.substring(0, decimal_pos);
        var right_side = input_val.substring(decimal_pos);

        left_side = formatNumber(left_side);

        right_side = formatNumber(right_side);

        if (blur === "blur") {
            right_side += "00";
        }

        right_side = right_side.substring(0, 2);

        input_val = left_side + "." + right_side + currencyChar;

    } else {
        input_val = formatNumber(input_val);

        if (blur === "blur") {
            input_val += ".00";
        }
        input_val = input_val + currencyChar;

    }
    input.val(input_val);
    var updated_len = input_val.length;
    caret_pos = updated_len - original_len + caret_pos;
    input[0].setSelectionRange(caret_pos, caret_pos);
}
function encodeStringUrl(url) {
    var encodedUrl = null;
    try {
        encodedUrl = URLEncoder.encode(url, "UTF-8");
    } catch (e) {
        return encodedUrl;
    }
    return decodedUrl;
}

function decodeStringUrl(encodedUrl) {
    var decodedUrl = null;
    try {
        decodedUrl = URLDecoder.decode(encodedUrl, "UTF-8");
    } catch (e) {
        return decodedUrl;
    }

    return decodedUrl;
}

function uuidv4() {
    return "10000000-1000-4000-8000-100000000000".replace(/[018]/g, c =>
        (+c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> +c / 4).toString(16)
    );
}

function getCountryName(countryCode) {
    const countries = {
        'ES': 'España',
        'FR': 'Francia',
        'IT': 'Italia',
        'DE': 'Alemania',
        'PT': 'Portugal'
    };
    return countries[countryCode] || countryCode;
}

function getQueryParam(param) {
    const params = new URLSearchParams(window.location.search)
    return params.get(param)
}

function getContrastColor(bgColor, baseColor, minRatio = 4.5) {

    const hsl = hexToHSL(baseColor);
    let l = hsl.l;
    let dir = l > 0.5 ? -1 : 1;

    for (let i = 0; i < 20; i++) {
        const test = hslToHex(hsl.h, hsl.s, l);
        if (contrastRatio(bgColor, test) >= minRatio) return test;
        l += dir * 0.05;
        l = Math.max(0.02, Math.min(0.98, l));
    }

    const bgLuma = contrastRatio(bgColor, "ffffff") > contrastRatio(bgColor, "000000")
        ? "ffffff"
        : "000000";

    for (let i = 0; i <= 1; i += 0.05) {
        const mixed = mix(baseColor, bgLuma, i);
        if (contrastRatio(bgColor, mixed) >= minRatio) return mixed;
    }

    return bgLuma;
}

function mix(color1, color2, amount) {
    const c1 = hexToRGBArray(color1);
    const c2 = hexToRGBArray(color2);

    return "" + c1.map((v, i) =>
        Math.round(v + (c2[i] - v) * amount)
            .toString(16)
            .padStart(2, "0")
    ).join("");
}

function luminance(rgb) {
    return rgb.map(v => {
        v /= 255;
        return v <= 0.03928 ? v / 12.92 : Math.pow((v + 0.055) / 1.055, 2.4);
    }).reduce((a, v, i) => a + v * [0.2126, 0.7152, 0.0722][i], 0);
}

function contrastRatio(hex1, hex2) {
    const l1 = luminance(hexToRGBArray(hex1));
    const l2 = luminance(hexToRGBArray(hex2));
    return (Math.max(l1, l2) + 0.05) / (Math.min(l1, l2) + 0.05);
}

function hexToRGBArray(color) {
    if (color.length === 3)
        color = color.charAt(0) + color.charAt(0) + color.charAt(1) + color.charAt(1) + color.charAt(2) + color.charAt(2);
    else if (color.length !== 6)
        throw ('Invalid hex color: ' + color);
    var rgb = [];
    for (var i = 0; i <= 2; i++)
        rgb[i] = parseInt(color.substr(i * 2, 2), 16);
    return rgb;
}

function hexToHSL(hex) {
    hex = hex.replace("#", "");
    const r = parseInt(hex.substring(0, 2), 16) / 255;
    const g = parseInt(hex.substring(2, 4), 16) / 255;
    const b = parseInt(hex.substring(4, 6), 16) / 255;

    const max = Math.max(r, g, b), min = Math.min(r, g, b);
    let h, s, l = (max + min) / 2;

    if (max === min) {
        h = s = 0;
    } else {
        const d = max - min;
        s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
        switch (max) {
            case r: h = (g - b) / d + (g < b ? 6 : 0); break;
            case g: h = (b - r) / d + 2; break;
            case b: h = (r - g) / d + 4; break;
        }
        h *= 60;
    }

    return { h, s, l };
}

function hslToHex(h, s, l) {
    s /= 1;
    l /= 1;

    const k = n => (n + h / 30) % 12;
    const a = s * Math.min(l, 1 - l);
    const f = n =>
        l - a * Math.max(-1, Math.min(k(n) - 3, Math.min(9 - k(n), 1)));

    return "" + [f(0), f(8), f(4)]
        .map(x => Math.round(x * 255).toString(16).padStart(2, "0"))
        .join("");
}

function updateContrast() {
    document.querySelectorAll(".price-contrast").forEach(el => {
        const baseColor = el.dataset.color.replace('#', '');
        const origColor = el.dataset.originalcolor ? el.dataset.originalcolor.replace('#', '') : 'ffffff';
        const contrast = getContrastColor(baseColor, origColor, 3);

        el.style.color = '#' + contrast;
        el.style.fontWeight = "600";
    });
}

function calculateTax(price, taxPercent) {
    return parseFloat(price + (price * taxPercent) / 100).toFixed(2)

}