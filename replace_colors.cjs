const fs = require('fs');
const path = require('path');

const directory = path.join(__dirname, 'resources', 'views');

const colorMap = {
    '[#1D1D1D]': 'uptodo-bg',
    '[#1d1d1d]': 'uptodo-bg',
    '[#272727]': 'uptodo-surface',
    '[#363636]': 'uptodo-surface2',
    '[#8875FF]': 'uptodo-purple',
    '[#8875ff]': 'uptodo-purple',
    '[#6B5CE7]': 'uptodo-purple-dark',
    '[#6b5ce7]': 'uptodo-purple-dark',
    '[#AFAFAF]': 'uptodo-muted',
    '[#afafaf]': 'uptodo-muted',
    '[#3E3E3E]': 'uptodo-border',
    '[#3e3e3e]': 'uptodo-border'
};

function walkDir(dir, callback) {
    fs.readdirSync(dir).forEach(f => {
        let dirPath = path.join(dir, f);
        let isDirectory = fs.statSync(dirPath).isDirectory();
        isDirectory ? walkDir(dirPath, callback) : callback(path.join(dir, f));
    });
}

let changedFilesCount = 0;

walkDir(directory, function(filePath) {
    if (!filePath.endsWith('.blade.php')) return;
    
    let originalData = fs.readFileSync(filePath, 'utf8');
    let data = originalData;
    
    Object.keys(colorMap).forEach(key => {
        data = data.split(key).join(colorMap[key]);
    });

    if (data !== originalData) {
        fs.writeFileSync(filePath, data);
        console.log('Updated: ' + filePath);
        changedFilesCount++;
    }
});

console.log('Total files updated: ' + changedFilesCount);
