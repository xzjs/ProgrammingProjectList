import {app, Menu, BrowserWindow} from 'electron'

/**
 * Set `__static` path to static files in production
 * https://simulatedgreg.gitbooks.io/electron-vue/content/en/using-static-assets.html
 */
if (process.env.NODE_ENV !== 'development') {
    global.__static = require('path').join(__dirname, '/static').replace(/\\/g, '\\\\')
}

let mainWindow
const winURL = process.env.NODE_ENV === 'development'
    ? `http://localhost:9080`
    : `file://${__dirname}/index.html`

let fs = require("fs");
let template = [
    {
        label: '文件',
        submenu: [
            {
                label: '打开',
                click: function (item, focusedWindow) {
                    if (focusedWindow) {
                        mainWindow.webContents.send('file', 'open');
                    }
                }
            },
            {
                label: '保存',
                click: function (item, focusedWindow) {
                    if (focusedWindow) {
                        mainWindow.webContents.send('file', 'save');
                    }
                }
            }
        ]
    },
    {
        label: '查看',
        submenu: [{
            label: '重载',
            accelerator: 'CmdOrCtrl+R',
            click: function (item, focusedWindow) {
                if (focusedWindow) {
                    // 重载之后, 刷新并关闭所有的次要窗体
                    if (focusedWindow.id === 1) {
                        BrowserWindow.getAllWindows().forEach(function (win) {
                            if (win.id > 1) {
                                win.close()
                            }
                        })
                    }
                    focusedWindow.reload()
                }
            }
        }, {
            label: '切换全屏',
            accelerator: (function () {
                if (process.platform === 'darwin') {
                    return 'Ctrl+Command+F'
                } else {
                    return 'F11'
                }
            })(),
            click: function (item, focusedWindow) {
                if (focusedWindow) {
                    focusedWindow.setFullScreen(!focusedWindow.isFullScreen())
                }
            }
        }, {
            label: '切换开发者工具',
            accelerator: (function () {
                if (process.platform === 'darwin') {
                    return 'Alt+Command+I'
                } else {
                    return 'Ctrl+Shift+I'
                }
            })(),
            click: function (item, focusedWindow) {
                if (focusedWindow) {
                    focusedWindow.toggleDevTools()
                }
            }
        }, {
            type: 'separator'
        }, {
            label: '应用程序菜单演示',
            click: function (item, focusedWindow) {
                if (focusedWindow) {
                    const options = {
                        type: 'info',
                        title: '应用程序菜单演示',
                        buttons: ['好的'],
                        message: '此演示用于 "菜单" 部分, 展示如何在应用程序菜单中创建可点击的菜单项.'
                    }
                    electron.dialog.showMessageBox(focusedWindow, options, function () {
                    })
                }
            }
        }]
    }
];

function createWindow() {
    /**
     * Initial window options
     */
    mainWindow = new BrowserWindow({
        height: 563,
        useContentSize: true,
        width: 1000
    })

    const menu = Menu.buildFromTemplate(template);
    Menu.setApplicationMenu(menu);

    mainWindow.loadURL(winURL)

    mainWindow.on('closed', () => {
        mainWindow = null
    })
}

app.on('ready', createWindow)

app.on('window-all-closed', () => {
    if (process.platform !== 'darwin') {
        app.quit()
    }
})

app.on('activate', () => {
    if (mainWindow === null) {
        createWindow()
    }
})

/**
 * Auto Updater
 *
 * Uncomment the following code below and install `electron-updater` to
 * support auto updating. Code Signing with a valid certificate is required.
 * https://simulatedgreg.gitbooks.io/electron-vue/content/en/using-electron-builder.html#auto-updating
 */

/*
import { autoUpdater } from 'electron-updater'

autoUpdater.on('update-downloaded', () => {
  autoUpdater.quitAndInstall()
})

app.on('ready', () => {
  if (process.env.NODE_ENV === 'production') autoUpdater.checkForUpdates()
})
 */
