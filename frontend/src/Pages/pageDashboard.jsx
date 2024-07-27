import React from "react";
import "bootstrap/dist/css/bootstrap.min.css";
import { NavLink } from "react-router-dom";

const Dashboard = () => {
  return (
    <div className="container mt-5">
      <h2 className="mb-4">Admin Dashboard</h2>
      <div className="list-group" style={{ width: "20%" }}>
        <NavLink
          to="/dashboard/users"
          type="button"
          className="list-group-item list-group-item-action"
          aria-current="true"
        >
          Manager Users
        </NavLink>
        <NavLink
          to="/dashboard/categories"
          type="button"
          className="list-group-item list-group-item-action"
        >
          Manager Kategori
        </NavLink>
        <NavLink
          to="/dashboard/products"
          type="button"
          className="list-group-item list-group-item-action"
        >
          Manage Produk
        </NavLink>
      </div>
    </div>
  );
};

export default Dashboard;
