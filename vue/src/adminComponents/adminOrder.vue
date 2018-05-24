<template>
    <div style="height: 100%">
        <div class="adminBox" id="adminOrder">
            <div class="breadcrumb">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item>订单</el-breadcrumb-item>
                </el-breadcrumb>
            </div>
            <div class="main">
                <div class="search-form">
                    <el-form :inline="true" class="demo-form-inline">
                        <el-form-item label="搜索">
                            <el-input class="search-input" icon="search" v-model="schfilter" placeholder="搜索用户号"></el-input>
                        </el-form-item>
                    </el-form>
                </div>
                <div class="search-main">
                    <el-table :data="tableData" :default-sort="{prop: 'tableData', order: 'descending'}" style="width: 100%; height: 100%;">
                        <el-table-column prop="_id" sortable label="订单号" width="180">
                        </el-table-column>
                        <el-table-column prop="part_name" label="配件名" sortable width="120">
                        </el-table-column>
                        <el-table-column prop="user_phone" label="手机号" sortable width="120">
                        </el-table-column>
                        <el-table-column prop="price" sortable label="价格" width="120">
                        </el-table-column>
                        <el-table-column prop="number" sortable label="数量" width="120">
                        </el-table-column>
                        <el-table-column prop="tag" label="支付状态" width="120">
                            <template slot-scope="scope">
                                <el-tag :type="scope.row.order_state == 0 ? 'primary' : scope.row.order_state == -1 ? 'danger' : 'success'" close-transition>{{scope.row.order_state == 0 ? '未支付' : scope.row.order_state == -1 ? '支付失败' : '支付成功'}}</el-tag>
                            </template>
                        </el-table-column>
                        <el-table-column>
                        </el-table-column>
                        <el-table-column label="操作" width="180">
                            <template slot-scope="scope">
                                <el-button size="mini" @click="pay(scope.$index, scope.row)" type="success">支付</el-button>
                                <el-button size="mini" @click="handleDelete(scope.$index, scope.row)" type="danger">删除</el-button>
                            </template>
                        </el-table-column>
                    </el-table>
                    <el-dialog title="支付" :visible.sync="dialogVisiblePay" width="30%">
                        <p>是否支付</p>
                        <span slot="footer" class="dialog-footer">
                            <el-button @click="dialogVisiblePay = false">取 消</el-button>
                            <el-button type="primary" @click="PaySubmit()">确 定</el-button>
                        </span>
                    </el-dialog>
                    <el-dialog title="删除" :visible.sync="dialogVisibleDelete" width="30%">
                        <p>是否删除</p>
                        <span slot="footer" class="dialog-footer">
                            <el-button @click="dialogVisibleDelete = false">取 消</el-button>
                            <el-button type="primary" @click="DeleteSubmit()">确 定</el-button>
                        </span>
                    </el-dialog>
                </div>
            </div>
        </div>
    </div>
</template>
<script>
export default {
    name: 'adminOrder',
    data() {
        return {
            dialogVisiblePay: false,
            dialogVisibleDelete: false,
            schfilter: '',
            tableData: [],
            filterTableDataEnd: [],
            tableDataBackups: [],
            payData: {},
            payIndex: 0,
            deleteData: {},
            deleteIndex: 0,
        }
    },
    methods: {
        pay(index, row) {
            this.payData = {};
            for (let i in (index, row)) {
                this.$set(this.payData, i, (index, row)[i]);
            }
            this.payIndex = index;
            this.dialogVisiblePay = true;
        },
        handleDelete(index, row) {
            this.deleteData = {};
            for (let i in (index, row)) {
                this.$set(this.deleteData, i, (index, row)[i]);
            }
            this.deleteIndex = index;
            this.dialogVisibleDelete = true;
        },
        PaySubmit() {
            var data = {};
            data.data = this.payData;
            var that = this;
            this.$http.post('/final/admin/order/pay', data, { emulateJSON: true }).then((response) => {
                if (response.body.code == 1) {
                    that.payData = {};
                    this.$set(that.tableData[that.payIndex], 'order_state', response.body.data);
                    that.$message({
                        message: response.body.message,
                        type: 'success'
                    });
                } else if (response.body.code == 0) {
                    that.$message({
                        message: response.body.message,
                        type: 'error'
                    });
                }
                that.dialogVisiblePay = false;
            });
        },
        DeleteSubmit(){
            var data = {};
            data.data = this.deleteData;
            var that = this;
            this.$http.post('/final/admin/order/delete', data, { emulateJSON: true }).then((response) => {
                if(response.body.code == 1){
                    that.deleteData = {};
                    that.tableData.splice(that.deleteIndex, 1);
                    that.$message({
                        message: response.body.message,
                        type: 'success'
                    });
                }
                that.dialogVisibleDelete = false;
            });
        }
    },
    created() {
        this.$http.post('/final/admin/order', { emulateJSON: true }).then((response) => {
            this.tableData = response.body.data;
            this.tableDataBackups = response.body.data;
        });
    },
    watch: {
        schfilter() {
            if (this.schfilter == "") {
                this.tableData = this.tableDataBackups;
                return;
            }
            this.filterTableDataEnd = []
            this.tableDataBackups.forEach((value, index) => {
                if (value._id) {
                    if (value._id.indexOf(this.schfilter) >= 0) {
                        this.filterTableDataEnd.push(value);
                        return true
                    }
                }
                if (value.part_name) {
                    if (value.part_name.indexOf(this.schfilter) >= 0) {
                        this.filterTableDataEnd.push(value);
                        return true
                    }
                }
                if (value.user_phone) {
                    if (value.user_phone.indexOf(this.schfilter) >= 0) {
                        this.filterTableDataEnd.push(value);
                        return true
                    }
                }
            });
            this.tableData = this.filterTableDataEnd;
        }
    }
}
</script>