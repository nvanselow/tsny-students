<div ng-app="TsnyApp">
    <div layout="column" layout-fill role="main">
        <md-toolbar ng-controller="SchoolsController as SchoolsCtrl">
            <div class="md-toolbar-tools">
                <h2 hide-sm>
                    <span>TSNY Student Notes</span>
                </h2>
                <span layout-padding>
                    <span ng-if="SchoolsCtrl.loading"><md-progress-circular md-mode="indeterminate" class="md-accent" md-diameter="35"></md-progress-circular></span>
                    <md-input-container ng-if="!SchoolsCtrl.loading">
                        <label>Current School: </label>
                        <md-select ng-model="SchoolsCtrl.user_info.current_school.id" ng-change="SchoolsCtrl.school_changed()">
                            <md-option ng-value="school.id" ng-repeat="school in SchoolsCtrl.schools track by school.id">
                                {{ school.name }}
                            </md-option>
                        </md-select>
                    </md-input-container>
                </span>
                <span flex></span>
                <span>{{SchoolsCtrl.user_info.current_school.id}} - {{SchoolsCtrl.user_info.current_school.name}}</span>
                <md-button>Logout</md-button>
            </div>

        </md-toolbar>
        <md-content layout-padding>
            <div class="title">TSNY Student Notes</div>
        </md-content>
    </div>
</div>
