import React, { Component } from 'react';
import { render } from 'react-dom';
// Import routing components
import {Router, Route, browserHistory} from 'react-router';
// Import custom components
import Home from '../containers/Home';
import Nav from './Nav';
import Post from './Post';
import Tags from  '../containers/Tags';
render(
    <Router history={browserHistory}>
        <Route component={Nav} path="/">
            <Route path="/posts" component={Home}/>
            <Route path="/posts/:slug" component={Post}/>
            <Route path="/tags" component={Tags}/>
            <Route path="/tags/:tag" component={Home}/>
        </Route>
    </Router>,
    document.getElementById('container')
);