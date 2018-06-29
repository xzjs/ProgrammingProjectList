<template>
    <div>
        <div>
            允许评论
            <el-switch
                    v-model="can_reply"
                    active-color="#13ce66"
                    inactive-color="#ff4949">
            </el-switch>
        </div>
        <div class="input">
            <el-input
                    type="textarea"
                    :autosize="{ minRows: 2, maxRows: 4}"
                    placeholder="请输入内容"
                    v-model="text">
            </el-input>
            <el-button v-if="can_reply" type="primary" class="btn" @click="add()">提交</el-button>
        </div>
        <div>
            <div v-for="(message,index) in messages" v-bind:key="index" class="message">
                <p class="message-p">{{message.content}}</p>
                <span class="message-time">{{message.time}}</span>
                <el-button v-if="can_reply" type="text" class="reply-btn" @click="reply_btn_click(index)">回复</el-button>
                <el-input v-if="reply_show_index==index" v-model="reply_content">
                    <el-button slot="append" @click="reply(index)">提交</el-button>
                </el-input>
                <div>
                    <div v-for="(reply,index) in message.replies" v-bind:key="index">
                        <p>{{reply.content}}</p>
                        <span class="reply-time">{{reply.time}}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "message-board",
        data() {
            return {
                messages: [
                    {
                        content: '我来踩踩',
                        time: '2018.6.29 13:00:00',
                        replies: [
                            {
                                content: '我是回复',
                                time: '2018.6.29 13:00:00'
                            },
                            {
                                content: '我是回复',
                                time: '2018.6.29 13:00:00'
                            }
                        ]
                    },
                    {
                        content: '我来踩踩2',
                        time: '2018.6.29 14:00:00',
                        replies: []
                    },
                ],
                text: '',
                reply_show_index: -1,
                reply_content: '',
                can_reply: true,
            }
        },
        methods: {
            add() {
                let mydate = new Date();
                let message = {
                    content: this.text,
                    time: mydate.toLocaleDateString() + ' ' + mydate.toLocaleTimeString(),
                    replies: []
                };
                this.messages.push(message);
                this.text = '';
            },
            reply_btn_click(index) {
                this.reply_show_index = index;
            },
            reply(index) {
                let mydate = new Date();
                let reply = {
                    content: this.reply_content,
                    time: mydate.toLocaleDateString() + ' ' + mydate.toLocaleTimeString()
                };
                this.messages[index].replies.push(reply);
                this.reply_content = '';
                this.reply_show_index = -1;
            }
        }
    }
</script>

<style scoped>
    div {
        margin: 5px 0;
    }

    .input {
        overflow: hidden;
    }

    .btn {
        float: right;
    }

    .message-p {
        font-size: 24px;
    }

    .message {
        border-bottom: black solid 1px;
    }

    .reply-btn {
        float: right;
    }

    .message-time {
        line-height: 40px;
    }

    .reply-time {
        font-size: 6px;
    }
</style>