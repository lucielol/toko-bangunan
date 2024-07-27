import React from "react";
import "./App.css";
import { BrowserRouter, Routes, Route } from "react-router-dom";
import NavigationBar from "./components/NavigationBar";
import Intro from "./components/Intro";
import Service from "./components/Service";
import Isiservice from "./components/Isiservice";
import TextService from "./components/TextService";
import About from "./components/About";
import DescAbout from "./components/DescAbout";
import VMSAbout from "./components/VMSAbout";
import ContactUs from "./components/ContactUs";
import PageCategory from "./Pages/pageCategory";
import Login from "./Pages/pageLogin";
import Dashboard from "./Pages/pageDashboard";
import Users from "./Pages/Users/index";
import Categories from "./Pages/Category/index";
import Products from "./Pages/Product/index";
import "./style/landingPage.css";

function App() {
  return (
    <BrowserRouter>
      <Routes>
        <Route
          path="/"
          element={
            <>
              <div className="myBG">
                <NavigationBar />
                <Intro />
              </div>
              <div className="serviceBG">
                <Service />
                <Isiservice />
                <TextService />
              </div>
              <div className="aboutBG">
                <About />
                <DescAbout />
                <VMSAbout />
              </div>
              <div className="contactBG">
                <ContactUs />
              </div>
            </>
          }
        />

        <Route path="/login" element={<Login />} />
        <Route path="/dashboard" element={<Dashboard />} />
        <Route path="/dashboard/users" element={<Users />} />
        <Route path="/dashboard/categories" element={<Categories />} />
        <Route path="/dashboard/products" element={<Products />} />
      </Routes>
    </BrowserRouter>
  );
}

export default App;
