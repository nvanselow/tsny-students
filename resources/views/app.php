<div ng-app="TsnyApp">
    <div layout="column" layout-fill role="main">
        <md-toolbar>
            <div class="md-toolbar-tools">
                <h2>
                    <span>TSNY Student Notes</span>
                </h2>
                <span layout-margin>
                    <md-input-container ng-controller="SchoolsController as SchoolsCtrl">
                        <label>Current School: </label>
                        <md-select ng-model="someModel">
                            <md-option ng-value="school" ng-repeat="school in SchoolsCtrl.schools" multiple="false" placeholder="Choose a school...">{{ school }}</md-option>
                        </md-select>
                    </md-input-container>
                </span>
                <span flex></span>
                <md-button>Logout</md-button>
            </div>

        </md-toolbar>
        <md-content layout-padding>
            <div class="title">TSNY Student Notes</div>
        </md-content>
    </div>
</div>
