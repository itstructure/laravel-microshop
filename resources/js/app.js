require('./bootstrap');

import React from 'react';
import ReactDOM from 'react-dom';
import Card from './components/Card';

if (document.getElementById('root')) {
    ReactDOM.render(<Card />, document.getElementById('root'));
}
