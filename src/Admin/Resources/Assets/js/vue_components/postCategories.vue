<template>
    <div class="form-group">
        <label for="category">Category</label>
        <select name="category" class="form-control" v-model="SelectedCategory" v-on:change="updateDropdowns(SelectedCategory)">
            <option v-for="item in Dropdown"
                    v-bind:value="item.value"
                    >{{ item.display }}
            </option>
        </select>
    </div>

    <div class="form-group">
        <label for="sub_category">Sub Category</label>
        <select name="sub_category" class="form-control" v-model="SelectedSubCategory">
            <option v-for="item in ChildDropdown" v-bind:value="item.value">{{ item.display }}</option>
        </select>
    </div>
</template>

<script>
    module.exports = {
        props: {
            DropdownImport: {default: []},
            SelectedCategory:{},
            SelectedSubCategory:{}
        },
        data: function () {
            return {
                Dropdown: [],
                ChildDropdown: []
            }
        },
        methods: {
            updateDropdowns: function (category) {
                var self = this;
                this.Dropdown.forEach(function (item) {
                    if (item.value == category) {
                        self.$set('ChildDropdown', item.sub_categories);
                    }
                });
            }
        },
        ready: function () {
            this.Dropdown = JSON.parse(this.DropdownImport);
            this.updateDropdowns(this.SelectedCategory);
        }
    }
</script>