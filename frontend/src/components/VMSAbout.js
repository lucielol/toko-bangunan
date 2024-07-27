import { Col, Row, Container } from "react-bootstrap";
import "../style/landingPage.css"

const VMSAbout = () => {
    return (
        <div className="vmsabout ">
            <Container className="text-white text-right d-flex justify-content-center align-items-center ">
                <Row>
                    <Col>
                        <p className="VMS">Our Vision</p>
                        <div className="descWrapped">
                            <p className="descVM">1. Destinasi utama untuk kebutuhan bangunan.</p>
                            <p className="descVM">2. Memimpin dalam layanan kuli berkualitas.</p>
                            <p className="descVM">3. Mengintegrasikan inovasi dan kreativitas.</p>
                            <p className="descVM">4. Membangun kemitraan yang kuat.</p>
                            <p className="descVM">5. Berkontribusi pada pembangunan berkelanjutan..</p>
                        </div>
                    </Col>
                </Row>
            </Container>
            <Container className="text-white text-center d-flex justify-content-center align-items-center ">
                <Row>
                    <Col>
                        <p className="VMS">OUR SLOGAN</p>
                        <p className="slogan">JAWA</p>
                        <p className="slogan">JAWA</p>
                        <p className="slogan">JAWA</p>
                    </Col>
                </Row>
            </Container>
            <Container className="text-white text-right d-flex justify-content-center align-items-center ">
                <Row>
                    <Col>
                        <p className="VMS">Our Mission</p>
                        <div className="descWrapped">
                            <p className="descVM">Kami berkomitmen memberikan pelayanan terbaik dengan produk berkualitas tinggi dan layanan kuli yang handal. Fokus kami adalah pada kepuasan pelanggan, inovasi berkelanjutan, dan kontribusi positif pada lingkungan dan masyarakat. Dengan dedikasi kami, kami bertujuan menjadi mitra terpercaya dalam memenuhi semua kebutuhan bangunan pelanggan kami, membangun masa depan yang berkelanjutan.</p>
                        </div>
                    </Col>
                </Row>
            </Container>
        </div>

    )
}

export default VMSAbout;