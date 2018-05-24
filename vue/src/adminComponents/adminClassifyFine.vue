<template>
    <div style="height: 100%">
        <div class="adminBox" id="adminClassifyFine">
            <div class="breadcrumb">
                <el-breadcrumb separator="/">
                    <el-breadcrumb-item>配件分类</el-breadcrumb-item>
                    <el-breadcrumb-item>细分类</el-breadcrumb-item>
                </el-breadcrumb>
            </div>
            <div class="main">
                <div class="search-form">
                    <el-form :inline="true" class="demo-form-inline">
                        <el-form-item label="搜索">
                            <el-input lass="search-input" icon="search" v-model="schfilter" placeholder="搜索分类名称"></el-input>
                        </el-form-item>
                        <el-form-item>
                            <el-button type="primary" @click="dialogVisibleInsert = true">添加</el-button>
                        </el-form-item>
                    </el-form>
                </div>
                <div class="search-main">
                    <el-table :data="tableData" :default-sort="{prop: 'tableData', order: 'descending'}" style="width: 100%; height: 100%;">
                        <el-table-column prop="fitting_ident" label="分类号" sortable width="180">
                        </el-table-column>
                        <el-table-column prop="name" label="名称" sortable width="180">
                        </el-table-column>
                        <el-table-column prop="classify_name" label="总分类" sortable width="180">
                        </el-table-column>
                        <el-table-column prop="icon" label="图标" sortable width="220">
                        </el-table-column>
                        <el-table-column>
                        </el-table-column>
                        <el-table-column label="操作" width="180">
                            <template slot-scope="scope">
                                <el-button size="mini" @click="handleEdit(scope.$index, scope.row)">编辑</el-button>
                                <el-button size="mini" @click="handleDelete(scope.$index, scope.row)" type="danger">删除</el-button>
                            </template>
                        </el-table-column>
                    </el-table>
                </div>
            </div>
            <el-dialog title="警告" :visible.sync="dialogVisibleDelete" width="30%">
                <span>是否删除该段数据</span>
                <span slot="footer" class="dialog-footer">
                    <el-button @click="dialogVisibleDelete = false">取 消</el-button>
                    <el-button type="primary" @click="DeleteSubmit()">确 定</el-button>
                </span>
            </el-dialog>
            <el-dialog title="编辑" :visible.sync="dialogVisibleEdit" width="30%">
                <el-form label-position="top" label-width="80px" :model="editData">
                    <el-form-item label="名称">
                        <el-input v-model="editData.name"></el-input>
                    </el-form-item>
                    <el-form-item label="总分号">
                        <el-input v-model="editData.classify_ident"></el-input>
                    </el-form-item>
                    <el-form-item label="图标">
                        <el-input v-model="editData.icon"></el-input>
                    </el-form-item>
                </el-form>
                <span slot="footer" class="dialog-footer">
                    <el-button @click="dialogVisibleEdit = false">取 消</el-button>
                    <el-button type="primary" @click="EditSubmit()">确 定</el-button>
                </span>
            </el-dialog>
            <el-dialog title="添加" :visible.sync="dialogVisibleInsert" width="30%">
                <el-form label-position="top" label-width="80px" :model="insertData">
                    <el-form-item label="分类号">
                        <el-input v-model="insertData.fitting_ident"></el-input>
                    </el-form-item>
                    <el-form-item label="总分号">
                        <el-input v-model="insertData.classify_ident"></el-input>
                    </el-form-item>
                    <el-form-item label="名称">
                        <el-input v-model="insertData.name"></el-input>
                    </el-form-item>
                    <el-form-item label="图标">
                        <el-input v-model="insertData.icon"></el-input>
                    </el-form-item>
                </el-form>
                <span slot="footer" class="dialog-footer">
                    <el-button @click="dialogVisibleInsert = false">取 消</el-button>
                    <el-button type="primary" @click="InsertSubmit()">确 定</el-button>
                </span>
            </el-dialog>
        </div>
    </div>
</template>
<script>
export default {
    name: 'adminClassifyFine',
    data() {
        return {
            dialogVisibleDelete: false,
            dialogVisibleEdit: false,
            dialogVisibleInsert: false,
            schfilter: '',
            tableData: [],
            filterTableDataEnd: [],
            tableDataBackups: [],
            editData: {},
            deleteData: {},
            insertData: {}
        }
    },
    methods: {
        handleEdit(index, row) {
            for(let i in (index, row)){
                this.$set(this.editData, i, (index, row)[i]);
            }
            this.dialogVisibleEdit = true;
        },
        handleDelete(index, row) {
            this.dialogVisibleDelete = true;
            this.deleteData = (index, row);
        },
        EditSubmit() {
            var data = {};
            data.data = this.editData;
            var that = this;
            this.$http.post('/final/admin/classifyFine/Updata', data, { emulateJSON: true }).then((response) => {
                that.editData = {};
                that.$http.post('/final/admin/classifyFine', { emulateJSON: true }).then((response) => {
                    that.tableData = response.body.data;
                    that.tableDataBackups = response.body.data;
                });
                that.$message({
                    message: response.body.message,
                    type: 'success'
                });
                that.dialogVisibleEdit = false;
            });
        },
        DeleteSubmit() {
            var data = {};
            data.data = this.deleteData;
            var that = this;
            this.$http.post('/final/admin/classifyFine/Delete', data, { emulateJSON: true }).then((response) => {
                that.deleteData = {};
                that.$http.post('/final/admin/classifyFine', { emulateJSON: true }).then((response) => {
                    that.tableData = response.body.data;
                    that.tableDataBackups = response.body.data;
                });
                that.$message({
                    message: response.body.message,
                    type: 'success'
                });
                that.dialogVisibleDelete = false;
            });
        },
        InsertSubmit() {
            var data = {};
            data.data = this.insertData;
            var that = this;
            this.$http.post('/final/admin/classifyFine/Insert', data, { emulateJSON: true }).then((response) => {
                if (response.body.code == 1) {
                    that.insertData = {};
                    that.$http.post('/final/admin/classifyFine', { emulateJSON: true }).then((response) => {
                        that.tableData = response.body.data;
                        that.tableDataBackups = response.body.data;
                    });
                    that.$message({
                        message: response.body.message,
                        type: 'success'
                    });
                    that.dialogVisibleInsert = false;
                }
                if (response.body.code == 0) {
                    that.$message({
                        message: response.body.message,
                        type: 'error'
                    });
                }
            });
        }
    },
    created() {
        this.$http.post('/final/admin/classifyFine', { emulateJSON: true }).then((response) => {
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
                    if (value.name) {
                        if (value.name.indexOf(this.schfilter) >= 0) {
                            this.filterTableDataEnd.push(value);
                            return true
                        }
                    }
                    if (value.business_name) {
                        if (value.business_name.indexOf(this.schfilter) >= 0) {
                            this.filterTableDataEnd.push(value);
                            return true
                        }
                    }
                    if (value.brand_name) {
                        if (value.brand_name.indexOf(this.schfilter) >= 0) {
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