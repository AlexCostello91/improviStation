export function capitalizeFirstLetter (str) {
    return str.charAt(0).toUpperCase() + str.slice(1);
};
export function formatDecimal(number, decimalPlaces = 2){
    if(Number.isInteger(number)){
        return number;
    } else {
        return Number(number).toFixed(decimalPlaces);
    }
};
