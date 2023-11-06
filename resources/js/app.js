import axios from 'axios';
import { Application } from '@hotwired/stimulus';
import IndexController from './controllers/index-controller';
import ListController from './controllers/list-controller';
import ThreadController from './controllers/thread-controller';
import ThreadItemsController from './controllers/thread-items-controller';
import EditorController from './controllers/editor-controller';
import FormController from './controllers/form-controller';

window.axios = axios;
window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

window.Stimulus = Application.start();
Stimulus.register('index', IndexController);
Stimulus.register('list', ListController);
Stimulus.register('thread', ThreadController);
Stimulus.register('thread-items', ThreadItemsController);
Stimulus.register('editor', EditorController);
Stimulus.register('form', FormController);