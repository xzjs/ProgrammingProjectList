<template>
    <div>
        <codemirror ref="myCm" v-model="code"></codemirror>
    </div>
</template>

<script>
    import {ipcRenderer} from 'electron';

    const {dialog} = require('electron').remote;
    const fs = require('fs');
    import {codemirror} from 'vue-codemirror'

    require("codemirror/mode/javascript/javascript.js");

    export default {
        data() {
            return {
                code: '',
                path: '',
            }
        },
        components: {
            codemirror,
        },
        computed: {
            codemirror() {
                return this.$refs.myCm.codemirror
            }
        },
        methods: {
            read() {
                this.path = dialog.showOpenDialog({properties: ['openFile']})[0];
                let buf = new Buffer(1024);
                fs.open(this.path, 'r+', (err, fd) => {
                    if (err) {
                        return console.log(err);
                    }
                    fs.read(fd, buf, 0, buf.length, 0, (err, bytes) => {
                        if (err) {
                            console.log(err);
                        }
                        if (bytes > 0) {
                            this.codemirror.setValue(buf.slice(0, bytes).toString());
                        }
                    });
                    // 关闭文件
                    fs.close(fd, function (err) {
                        if (err) {
                            console.log(err);
                        }
                    });
                });
            },
            save() {
                fs.writeFile(this.path, this.codemirror.getValue(), (err) => {
                    if (err) {
                        console.log(err);
                    } else {
                        this.$message({
                            message: '保存成功',
                            type: 'success'
                        });
                    }
                })
            }
        },
        mounted: function () {
            ipcRenderer.on('file', (event, message) => {
                switch (message) {
                    case 'open':
                        this.read();
                        break;
                    case 'save':
                        this.save();
                        break;
                }
            })
        }
    }
</script>

<style scoped>

</style>