const path = require('path');

module.exports = {
    entry: './css/bootstrap-5.3.0-dist/js/bootstrap.bundle.js', // Путь к вашему главному JS файлу
    output: {
        path: path.resolve(__dirname, 'dist'),
        filename: 'bundle.js', // Название выходного файла
    },
};