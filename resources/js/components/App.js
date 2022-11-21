import React from 'react';
import ReactDOM from 'react-dom';
import { BrowserRouter, Route, Routes } from 'react-router-dom';
import Home from './Menus/Home';
import About from './Menus/About';
import Contact from './Menus/Contact';
import NavBar from './Navigation/NavBar';


function App() {
    return (
        <>
            <NavBar/>
            <Routes>
                <Route exact  path='/' element={<Home/>} />
                <Route exact  path='/about' element={<About/>} />
                <Route exact  path='/contact' element={<Contact/>} />
            </Routes>
        </>
    );
}

export default App;

if (document.getElementById('app-root')) {
    ReactDOM.render(
        <BrowserRouter>
            <App />
        </BrowserRouter>
        , document.getElementById('app-root'));
}
