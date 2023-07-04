import React from 'react';
import * as ReactDOM from 'react-dom/client';
import Header from './header';

const headerElement = document.getElementById('react-header');
if (!headerElement) throw new Error('Failed to find the root element');
const header = ReactDOM.createRoot(headerElement);
header.render(<Header title='Ramen BBS' current_user_id={`${(window as any).current_user_id}`}></Header>);