import {Component, OnInit} from '@angular/core';
import {SettingsPanelComponent} from 'common/admin/settings/settings-panel.component';
import {FtpDetails} from '../../../shared/builder-types';

@Component({
    selector: 'builder-settings',
    templateUrl: './builder-settings.component.html',
    styleUrls: ['./builder-settings.component.scss'],
    host: {'class': 'settings-panel'},
})
export class BuilderSettingsComponent extends SettingsPanelComponent implements OnInit {
    public categories: string[] = [];
    public defaultPublishCredentials: FtpDetails = {};

    ngOnInit() {
        this.categories = this.settings.getJson('builder.template_categories', []);
        this.defaultPublishCredentials = this.settings.getJson('publish.default_credentials', {});
    }

    public saveSettings() {
        const settings = this.state.getModified();
        settings.client['builder.template_categories'] = JSON.stringify(this.categories);
        settings.client['publish.default_credentials'] = JSON.stringify(this.defaultPublishCredentials);
        super.saveSettings(settings);
    }
}
