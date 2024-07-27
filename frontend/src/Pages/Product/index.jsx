import React, { useEffect, useState } from "react";
import axios from "axios";
import "bootstrap/dist/css/bootstrap.min.css";
import { NavLink } from "react-router-dom";

const Products = () => {
  const [products, setProducts] = useState([]);
  const [loading, setLoading] = useState(true);
  const [error, setError] = useState("");
  const [selectedProduct, setSelectedProduct] = useState(null);
  const [showModal, setShowModal] = useState(false);
  const [isEditing, setIsEditing] = useState(false);

  useEffect(() => {
    const fetchData = async () => {
      try {
        const response = await axios.get(
          "http://localhost:8080/api?action=getProducts"
        );
        setProducts(response.data);
      } catch (error) {
        console.error("Error fetching products:", error);
        setError("Failed to load products.");
      } finally {
        setLoading(false);
      }
    };

    fetchData();
  }, []);

  const handleShowModal = (product) => {
    setSelectedProduct(product);
    setIsEditing(true);
    setShowModal(true);
  };

  const handleShowAddModal = () => {
    setSelectedProduct(null);
    setIsEditing(false);
    setShowModal(true);
  };

  const handleCloseModal = () => {
    setShowModal(false);
    setSelectedProduct(null);
  };

  const handleSave = async (e) => {
    e.preventDefault();
    const {
      nama_produk,
      deskripsi,
      harga,
      stok,
      kategori_id,
      tanggal_dibuat,
      gambar_url,
    } = e.target.elements;

    try {
      if (isEditing) {
        await axios.put("http://localhost:8080/api?action=updateProduct", {
          id: selectedProduct.id,
          nama_produk: nama_produk.value,
          deskripsi: deskripsi.value,
          harga: harga.value,
          stok: stok.value,
          kategori_id: kategori_id.value,
          tanggal_dibuat: tanggal_dibuat.value,
          gambar_url: gambar_url.value,
        });
      } else {
        await axios.post("http://localhost:8080/api?action=addProduct", {
          nama_produk: nama_produk.value,
          deskripsi: deskripsi.value,
          harga: harga.value,
          stok: stok.value,
          kategori_id: kategori_id.value,
          tanggal_dibuat: tanggal_dibuat.value,
          gambar_url: gambar_url.value,
        });
      }

      const response = await axios.get(
        "http://localhost:8080/api?action=getProducts"
      );
      setProducts(response.data);
      handleCloseModal();
    } catch (error) {
      console.error(
        `Error ${isEditing ? "updating" : "adding"} product:`,
        error
      );
      setError(`Failed to ${isEditing ? "update" : "add"} product.`);
    }
  };

  const handleDelete = async (id) => {
    try {
      await axios.delete(
        `http://localhost:8080/api?action=deleteProduct&id=${id}`
      );
      const response = await axios.get(
        "http://localhost:8080/api?action=getProducts"
      );
      setProducts(response.data);
    } catch (error) {
      console.error("Error deleting product:", error);
      setError("Failed to delete product.");
    }
  };

  if (loading) {
    return <div className="text-center">Loading...</div>;
  }

  return (
    <div className="container-fluid mt-5">
      <h2 className="text-center mb-4">
        <NavLink to="/dashboard" className="decoration-non">
          Kembali
        </NavLink>{" "}
        - Manage Products
      </h2>
      {error && (
        <div className="alert alert-danger" role="alert">
          {error}
        </div>
      )}
      <button className="btn btn-success mb-4" onClick={handleShowAddModal}>
        Add Product
      </button>
      <div className="row">
        <div className="col-12">
          <table className="table table-bordered">
            <thead>
              <tr>
                <th>ID</th>
                <th>Nama Produk</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Kategori ID</th>
                <th>Tanggal Dibuat</th>
                <th>Gambar URL</th>
                <th>Actions</th>
              </tr>
            </thead>
            <tbody>
              {products && products.length > 0 ? (
                products.map((product, index) => (
                  <tr key={index}>
                    <td>{index + 1}</td>
                    <td>{product.nama_produk}</td>
                    <td>{product.deskripsi}</td>
                    <td>{product.harga}</td>
                    <td>{product.stok}</td>
                    <td>{product.kategori_id}</td>
                    <td>{product.tanggal_dibuat}</td>
                    <td>{product.gambar_url}</td>
                    <td>
                      <button
                        className="btn btn-primary"
                        onClick={() => handleShowModal(product)}
                      >
                        Edit
                      </button>{" "}
                      <button
                        className="btn btn-danger"
                        onClick={() => handleDelete(product.id)}
                      >
                        Delete
                      </button>
                    </td>
                  </tr>
                ))
              ) : (
                <tr>
                  <td colSpan="9" className="text-center">
                    No products found
                  </td>
                </tr>
              )}
            </tbody>
          </table>
        </div>
      </div>

      <div
        className={`modal fade ${showModal ? "show" : ""}`}
        tabIndex="-1"
        style={{ display: showModal ? "block" : "none" }}
        aria-labelledby="exampleModalLabel"
        aria-hidden="true"
      >
        <div className="modal-dialog">
          <div className="modal-content">
            <div className="modal-header">
              <h5 className="modal-title" id="exampleModalLabel">
                {isEditing ? "Edit Product" : "Add Product"}
              </h5>
              <button
                type="button"
                className="btn-close"
                onClick={handleCloseModal}
                aria-label="Close"
              ></button>
            </div>
            <div className="modal-body">
              <form onSubmit={handleSave}>
                <div className="mb-3">
                  <label htmlFor="nama_produk" className="form-label">
                    Nama Produk
                  </label>
                  <input
                    type="text"
                    className="form-control"
                    id="nama_produk"
                    defaultValue={
                      selectedProduct ? selectedProduct.nama_produk : ""
                    }
                    name="nama_produk"
                    required
                  />
                </div>
                <div className="mb-3">
                  <label htmlFor="deskripsi" className="form-label">
                    Deskripsi
                  </label>
                  <textarea
                    className="form-control"
                    id="deskripsi"
                    defaultValue={
                      selectedProduct ? selectedProduct.deskripsi : ""
                    }
                    name="deskripsi"
                    required
                  />
                </div>
                <div className="mb-3">
                  <label htmlFor="harga" className="form-label">
                    Harga
                  </label>
                  <input
                    type="number"
                    className="form-control"
                    id="harga"
                    defaultValue={selectedProduct ? selectedProduct.harga : ""}
                    name="harga"
                    required
                    step="0.01"
                  />
                </div>
                <div className="mb-3">
                  <label htmlFor="stok" className="form-label">
                    Stok
                  </label>
                  <input
                    type="number"
                    className="form-control"
                    id="stok"
                    defaultValue={selectedProduct ? selectedProduct.stok : ""}
                    name="stok"
                    required
                  />
                </div>
                <div className="mb-3">
                  <label htmlFor="kategori_id" className="form-label">
                    Kategori ID
                  </label>
                  <input
                    type="number"
                    className="form-control"
                    id="kategori_id"
                    defaultValue={
                      selectedProduct ? selectedProduct.kategori_id : ""
                    }
                    name="kategori_id"
                    required
                  />
                </div>
                <div className="mb-3">
                  <label htmlFor="tanggal_dibuat" className="form-label">
                    Tanggal Dibuat
                  </label>
                  <input
                    type="date"
                    className="form-control"
                    id="tanggal_dibuat"
                    defaultValue={
                      selectedProduct ? selectedProduct.tanggal_dibuat : ""
                    }
                    name="tanggal_dibuat"
                    required
                  />
                </div>
                <div className="mb-3">
                  <label htmlFor="gambar_url" className="form-label">
                    Gambar URL
                  </label>
                  <input
                    type="text"
                    className="form-control"
                    id="gambar_url"
                    defaultValue={
                      selectedProduct ? selectedProduct.gambar_url : ""
                    }
                    name="gambar_url"
                    required
                  />
                </div>
                <button type="submit" className="btn btn-primary">
                  {isEditing ? "Save Changes" : "Add Product"}
                </button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  );
};

export default Products;
