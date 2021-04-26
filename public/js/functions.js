export const charsetFormat = (str) => {
    str.includes('Ã¡') && (str = str.replace('Ã¡', 'á'));
    str.includes('Ã?') && (str = str.replace('Ã?', 'Á'));
    str.includes('Ã©') && (str = str.replace('Ã©', 'é'));
    str.includes('Ã%') && (str = str.replace('Ã%', 'É'));
    str.includes('Ã­') && (str = str.replace('Ã', 'í'));


    str.includes('Ã³') && (str = str.replace('Ã³', 'ó'));
    str.includes('Ã“') && (str = str.replace('Ã“', 'Ó'));
    str.includes('Ãº') && (str = str.replace('Ãº', 'ú'));
    str.includes('Ãs') && (str = str.replace('Ãs', 'Ú'));

    str.includes('Ã±') && (str = str.replace('Ã±', 'ñ'));
    str.includes("Ã'") && (str = str.replace("Ã'", 'Ñ'));

    str.includes("Ã¤") && (str = str.replace("Ã¤", 'ä'));
    str.includes("Ã„") && (str = str.replace("Ã„", 'Ä'));
    str.includes("Ã«") && (str = str.replace("Ã«", 'ë'));
    str.includes("Ã<") && (str = str.replace("Ã<", 'Ë'));
    return str;
}