const chokidar = require('chokidar');
const fs = require('fs');
const path = require('path');
const lr = require('tiny-lr');
var done = (function wait () { if (!done) setTimeout(wait, 10000) })();

const watcherData = JSON.parse(fs.readFileSync(path.resolve(__dirname, 'monitor.json')));
const [fsPath] = process.argv.slice(2);

const server = lr();
server.listen(35731, function() {
    console.log('... Listening on 35731 ...');
});

let notifyTimeout;
let notifyFiles = [];

const notify = (file)=>{
    if(notifyTimeout) {
        clearTimeout(notifyTimeout);
    }
    const fileName = path.relative( path.resolve(__dirname, '..', 'public'), file);
    notifyFiles.push(fileName);
    notifyTimeout = setTimeout(()=>{
       console.log('LifeReload', notifyFiles);
       server.notifyClients(notifyFiles);
       notifyFiles = [];
       notifyTimeout = false;
    }, 500);
};

Object.entries(watcherData).forEach(([fromPath, toPath])=>{
    console.log(fromPath, toPath);
    setTimeout(()=>{
        const sourcePath = path.resolve(fsPath, fromPath);
        const targetPath = path.resolve(__dirname, '..', toPath);

        console.log(sourcePath, targetPath);

        const watcher = chokidar.watch(sourcePath, { persistent: true, usePolling: true });

        watcher.on('add', p => {
            const target = path.resolve(targetPath, path.relative(sourcePath, p));
            const source = p;
            console.log("\x1b[33m", `[${fromPath}] Added ${path.relative(sourcePath, p)}`);
            const dir=path.dirname(target);
            if (!fs.existsSync(dir)) {
                fs.mkdirSync(dir, {recursive: true});
            }
            fs.copyFileSync(source, target);

            notify(target);

        }).on('change', p => {
            const target = path.resolve(targetPath, path.relative(sourcePath, p));
            const source = p;
            console.log("\x1b[36m", `[${fromPath}] Updated ${path.relative(sourcePath, p)}`);
            const dir=path.dirname(target);
            if (!fs.existsSync(dir)) {
                fs.mkdirSync(dir, {recursive: true});
            }
            fs.copyFileSync(source, target);
            notify(target);
        }).on('unlink', p => {
            const target = path.resolve(targetPath, path.relative(sourcePath, p));
            const source = p;
            console.log("\x1b[31m", `[${fromPath}] Deleted ${path.relative(sourcePath, p)}`);
            notify(target);
            // fs.unlinkSync(target);
        });
    }, 100);

   /*
        watcher.on('add', async filePath => {
            if (filePath.includes('error.log')) {
                console.log(
                    `[${new Date().toLocaleString()}] ${filePath} has been added.`
                );

                // Read content of new file
                var fileContent = await fsExtra.readFile(filePath);

                // emit an event when new file has been added
                this.emit('file-added', {
                    message: fileContent.toString()
                });

                // remove file error.log
                await fsExtra.unlink(filePath);
                console.log(
                    `[${new Date().toLocaleString()}] ${filePath} has been removed.`
                );
            }
        });
    */
});
