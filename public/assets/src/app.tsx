import React from 'react';
import * as ReactDOM from 'react-dom/client';
import Header from './header';
 
const rootElement = document.getElementById('root');
if (!rootElement) throw new Error('Failed to find the root element');
const root = ReactDOM.createRoot(rootElement);
root.render(<Header title='Ramen BBS'/>);