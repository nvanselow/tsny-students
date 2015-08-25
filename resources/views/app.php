<div ng-app="TsnyApp">
    <div layout="column" layout-fill role="main">
        <md-toolbar ng-controller="SchoolsController as SchoolsCtrl">
            <div class="md-toolbar-tools">
                <h2 hide-sm>
                    <a href="#/">
                        TSNY Student Notes
                    </a>
                </h2>
                <span layout-padding>
                    <span ng-if="SchoolsCtrl.loading"><md-progress-circular md-mode="indeterminate" class="md-accent" md-diameter="35"></md-progress-circular></span>
                    <md-input-container ng-if="!SchoolsCtrl.loading">
                        <label>Current School: </label>
                        <md-select ng-model="SchoolsCtrl.user_info.current_school.id" ng-change="SchoolsCtrl.school_changed()">
                            <md-option ng-value="school.id" ng-repeat="school in SchoolsCtrl.School.schools track by school.id">
                                {{ school.name }}
                            </md-option>
                        </md-select>
                    </md-input-container>
                </span>
                <span flex></span>
                <span>
                    <md-autocomplete
                        md-selected-item="SchoolsCtrl.selected_student"
                        md-search-text-change="SchoolsCtrl.SearchForStudent(SchoolsCtrl.student_search_text)"
                        md-search-text="SchoolsCtrl.student_search_text"
                        md-selected-item-change="SchoolsCtrl.SelectedStudentChanged(student)"
                        md-items="student in SchoolsCtrl.student_search_results"
                        placeholder="Search for a student">
                        <md-item-template>
                            <span class="item-title" md-highlight-text="SchoolsCtrl.student_search_text" md-highlight-flags="^i">
                                {{student.first_name}} {{student.last_name}}
                            </span>
                            <span ng-if="student.nickname">({{student.nickname}})</span>
                            <span class="item-metadata">
                                - {{student.primary_school_name}}
                            </span>
                        </md-item-template>
                        <md-not-found>
                            No matches found for "{{ctrl.searchText}}".
                        </md-not-found>
                    </md-autocomplete>
                </span>
                <span flex></span>
                <span>{{SchoolsCtrl.user_info.current_school.id}} - {{SchoolsCtrl.user_info.current_school.name}}</span>
                <md-button href="/auth/logout">Logout</md-button>
            </div>
        </md-toolbar>

        <div ui-view></div>
    </div>
</div>
