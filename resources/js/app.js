import './bootstrap';
import utils from './utils';
import config from './config';
import indexInit from './index-init';

utils.docReady(indexInit(config.defaultSection));
